<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\ChurchEngagement;
use App\Family;
use App\UploadedFile;
use App\Http\Requests\Family\CreateFamilyRequest;
use App\Http\Requests\Family\UpdateFamilyRequest;
use App\Jobs\FamilyUpload;
use App\Member;
use App\MemberRole;
use App\SacramentQuestion;
use App\State;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $families = Family::globalSearch(['name', 'registration_number'])->with('head')->orderBy('name')->paginate(getPaginateSize());
        $required_fields = Family::getRequiredHeadingsAsString();
        return view('admin.families.index', compact('families', 'required_fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $state_list = State::pluck('name', 'id');
        $bcc_zone_list = BccZone::active()->pluck('name', 'id');
        $church_engagement_list = ChurchEngagement::pluck('name', 'id');
        $sacrament_question_list = SacramentQuestion::active()->pluck('question', 'id');
        $age_group_list = Member::AGE_GROUP_LIST;
        $marital_status_list = Member::MARITAL_STATUS_LIST;
        $card_status_list = Family::CARD_STATUS;

        return view('admin.families.create',
            compact('state_list', 'bcc_zone_list', 'church_engagement_list', 'sacrament_question_list',
                'age_group_list', 'marital_status_list', 'card_status_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFamilyRequest $request
     * @return Response
     * @throws Exception
     */
    public function store(CreateFamilyRequest $request)
    {
        $data = $request->all();
        $data['state_id'] = $data['state'];
        $data['bcc_zone_id'] = $data['bcc_zone'];
        $data['member_role_id'] = MemberRole::getHead();
        $data['phones'] = array_map('trim', explode(',', $data['phones']));
        $data['names_of_children'] = $data['children'];

        $sacrament_questions = [];
        SacramentQuestion::active()->pluck('id')->each(function ($id) use($data, &$sacrament_questions) {
            if(isset($data["sacrament_question_{$id}"])) {
                $sacrament_questions[$id] = ['response' => $data["sacrament_question_{$id}"]] ;
            }
        });

        try{
            DB::beginTransaction();
            $family = Family::create($data);
            $member = $family->members()->create($data);

            if(isset($data['church_engagements']))
                $member->church_engagements()->sync($data['church_engagements']);

            if(!empty($sacrament_questions))
                $member->sacrament_questions()->sync($sacrament_questions);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();

            throw new Exception($exception->getMessage());
        }


        $title = "Great Job!";
        $url = route('families.show', $family->id);
        $message = "Family created! " .
            "\nRegistration Number: {$family->registration_number}. " .
            "\nBy clicking 'OK' you will be redirected to the family page.";


        if($request->wantsJson()) return response()->json(['message' => $message, "title" => $title, "button_text" => "Ok", "url" => $url]);

        alert()->success($message, $title)->addButton("Ok", "Ok");

        return redirect()->route('families.show', ['family' => $family->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Family $family
     * @return Response
     */
    public function show(Family $family)
    {
        $family->load('members', 'head');
        return view('admin.families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Family $family
     * @return Response
     */
    public function edit(Family $family)
    {
        $state_list = State::pluck('name', 'id');
        $bcc_zone_list = BccZone::pluck('name', 'id');
        $card_status_list = Family::CARD_STATUS;

        $family->load('members', 'members.role', 'state', 'bcc_zone');

        $family_head_id = $family->head->id;
        $family_members = $family->members()
            ->selectRaw("CONCAT(first_name, ' ', last_name) AS name, id")
            ->pluck('name', 'id')->toArray();

        return view('admin.families.edit', compact('family', 'family_members', 'family_head_id', 'state_list', 'bcc_zone_list', 'card_status_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFamilyRequest $request
     * @param Family $family
     * @return Response
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $data = $request->all();
        $data['state_id'] = $data['state'];
        $data['bcc_zone_id'] = $data['bcc_zone'];
        $data['names_of_children'] = $data['children'];
        $data['family_head_id'] = $data['family_head'];

        $family->update($data);
        $family->setHead($data['family_head']);

        $title = "Success!";
        $message = "Family record updated.";

        if($request->wantsJson()) return response()->json(['message' => $message, "title" => $title]);

        alert()->success($message, $title);

        return redirect()->route('families.show', $family->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Family $family
     * @return bool|null
     * @throws Exception
     */
    public function destroy(Family $family)
    {
        $family->members->each(function ($member) {
            $member->delete();
        });

        if($family->delete())
            return response()->json(["title" => "Awesome!", "message" => "Family record deleted successfully!"]);

        return response()->json(["title" => "Whoops!", "message" => "Operation failed"], 500);
    }

    public function bulkUpload(Request $request) {

        $this->validate($request, [
            'excel_file' => 'required|file|mimes:csv,txt,xls,xlsx|max:5120'
        ], [
            'required' => 'No file selected'
        ]);

        $path = $request->file('excel_file')->store('files');

        $families = Excel::load(Storage::path($path), function ($reader) {
            $reader->all();
        })->get();


        if($error = Family::validateHeadings($families->getheading())) {
            Storage::delete($path);
            return back()->withErrors($error);
        }

        $type = 'FAMILY';
        $file = UploadedFile::create([
            'name' => nameFile($type),
            "path" => $path,
            "type" => $type,
            'status' => 'PROCESSING'
        ]);

        FamilyUpload::dispatch($file, $families)->delay(now()->addSecond(3))->onQueue('high');

        flash()->success("Success! File Uploaded. Processing records in background.");
        return redirect()->route('uploaded-files.index');
    }

    public function exportAll($type) {
        $this->export(NULL, $type);
    }


    public function export($id, $type) {
        if(!in_array($type, ['csv', 'xls', 'xlsx'])) return back()->withErrors('File type not allowed');


        if(is_null($id)){
            $families = Family::setEagerLoads([]);
            $file_name = date('Y_m_d_') . time();
        } else {
            $uploaded_file = UploadedFile::findOrFail($id);
            $file_name = $uploaded_file->name;
            $families = $uploaded_file->families();
        }

        $families = $families->with('state', 'bcc_zone', 'head')->orderBy('name')->get()->toArray();

        $ignore_headers = ['id', 'uploaded_file_id', 'state_id', 'bcc_zone_id', 'type', 'card_status'];

        Excel::create($file_name, function ($excel) use ($families, $ignore_headers) {
            $excel->sheet('Families', function ($sheet) use ($families, $ignore_headers) {
                $result = [];
                foreach ($families AS $k => $family) {
                    foreach ($family AS $key => $value) {
                        if(in_array($key, $ignore_headers)) continue;

                        $result[$k]['S/N'] = $k + 1;

                        if($key === 'type_text') {
                            $result[$k]['Type'] = $value;
                            continue;
                        }

                        if($key === 'state') {
                            $result[$k]['State'] = $value['name'];
                            continue;
                        }

                        if($key === 'bcc_zone') {
                            $result[$k]['Bcc Zone'] = $value['name'];
                            continue;
                        }

                        if($key === 'card_status_text') {
                            $result[$k]['Card Status'] = $value;
                            continue;
                        }

                        if($key === 'names_of_children') {
                            $result[$k]['Names of Children'] = implode(", ", $value);
                            continue;
                        }

                        if($key === 'head') {
                            $result[$k]['Head Name'] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
                            $result[$k]['Head Email'] = $value['email'];
                            $result[$k]['Phones'] = implode(", ", $value['phones']);
                            $result[$k]['Marital Status'] = $value['marital_status_text'];
                            $result[$k]['Age Group'] = $value['age_group_text'];
                            $result[$k]['Occupation'] = $value['occupation'];
                            continue;
                        }

                        $result[$k][normal_case($key)] = $value;

                    }
                }
                $sheet->fromArray($result);
                $sheet->row(1, function ($row) {
                    $row->setBackground('#000000');
                    $row->setFontColor('#00FF00');
                    $row->setFontWeight('bold');
                });
            });
        })->download($type);

        return false;
    }


    public function audits($id) {
        $family = Family::withTrashed()->findOrFail($id);

        $audits = $family->audits()->latest()->get();
        $translation = 'family';
        $model = Family::class;
        $title = "Audit Trail Report for the Family of <strong>{$family->name}</strong>";
        $heading = "Family Audit Trail Report <small>[{$family->name}]</small>";

        return view('admin.reports.audits.show', compact('audits', 'translation', 'model', 'title', 'heading'));
    }
}
