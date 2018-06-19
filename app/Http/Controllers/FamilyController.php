<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\ChurchEngagement;
use App\Family;
use App\Http\Requests\Family\CreateFamilyRequest;
use App\Http\Requests\Family\UpdateFamilyRequest;
use App\Jobs\FamilyUpload;
use App\Member;
use App\MemberRole;
use App\SacramentQuestion;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::globalSearch(['name', 'registration_number'])->with('head')->orderBy('name')->paginate(getPaginateSize());

        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     * @throws \Exception
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
        } catch (\Exception $exception) {
            DB::rollback();

            throw new \Exception($exception->getMessage());
        }

        $url = route('families.show', $family->id);
        $message = "Success! Family Created (Family RegNo.: <a href=\"{$url}\">{$family->registration_number})</a>";

        if($request->wantsJson()) return response()->json(['message' => $message]);

        flash()->success($message);
        return redirect()->route('families.show', ['family' => $family->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $family->load('members', 'head');
        return view('admin.families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
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
     * @param  \App\Family $family
     * @return \Illuminate\Http\Response
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

        $message = "Success! Family record updated.";
        if($request->wantsJson()) return response()->json(['message' => $message]);
        flash()->success($message);
        return redirect()->route('families.show', $family->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }

    public function batchUpload(Request $request) {

        $this->validate($request, [
            'excel_file' => 'required|file|mimes:csv,txt,xls,xlsx'
        ], [
            'required' => 'No file selected'
        ]);

        $path = $request->file('excel_file')->store('files');

        $families = Excel::load(Storage::path($path), function ($reader) {
            $reader->all();
        })->get();
        Storage::delete($path);

        if($error = Family::validateHeadings($families->getheading())) {
            return back()->withErrors($error);
        }

        FamilyUpload::dispatch($families)->delay(now()->addSecond(3))->onQueue('process');

        flash()->success("Success! File Uploaded. Processing records in background.");
        return redirect()->route('families.index');
    }

    public function audits(Family $family) {
        $audits = $family->audits()->latest()->get();
        $translation = 'family';
        $model = Family::class;
        $title = "Audit Trail Report for the Family of <strong>{$family->name}</strong>";
        $heading = "Family Audit Trail Report <small>[{$family->name}]</small>";
        return view('admin.reports.audits.show', compact('audits', 'translation', 'model', 'title', 'heading'));
    }
}
