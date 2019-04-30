<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\UploadedFile;
use App\Jobs\BccZoneBulkUpload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BccZoneController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|unique:bcc_zones,name',
        'address' => 'required|min:5',
        'streets' => 'required|array',
    ];
    private $messages = ['name.unique' => 'A Bcc zone with this name already exist.'];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bcc_zones = BccZone::paginate(getPaginateSize());
        $required_fields = BccZone::getRequiredHeadingsAsString();
        return view('admin.bcc_zones.index', compact('bcc_zones', 'required_fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.bcc_zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules, $this->messages);

        $bcc_zone = BccZone::create($request->all());

        $title = "Great Job!";
        $message = 'Bcc zone created';

        if($request->wantsJson())
            return response()->json([
                'message' => $message,
                "title" => $title,
                "button_text" => "Ok",
                "url" => route("bcc-zones.show", ["id" => $bcc_zone->id])
            ]);

        alert()->success($message, $title);

        return redirect()->route('bcc-zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param BccZone $bcc_zone
     * @return Response
     * @internal param int $id
     */
    public function show(BccZone $bcc_zone)
    {
        $bcc_zone->load('families');
        return view('admin.bcc_zones.show', compact('bcc_zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BccZone $bcc_zone
     * @return Response
     */
    public function edit(BccZone $bcc_zone)
    {
        return view('admin.bcc_zones.edit', compact('bcc_zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param BccZone $bcc_zone
     * @return Response
     */
    public function update(Request $request, BccZone $bcc_zone)
    {
        $this->rules['name'] .= ",{$bcc_zone->id}";
        $request->validate($this->rules, $this->messages);

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';
        $bcc_zone->update($data);

        $message = 'Bcc zone updated';
        $title = "Success!";

        if($request->wantsJson()) return response()->json(['message' => $message, "title" => $title]);

        alert()->success($message, $title);
        return redirect()->route('bcc-zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    public function bulkUpload(Request $request) {

        $this->validate($request, [
            'excel_file' => 'required|file|mimes:csv,txt,xls,xlsx'
        ], [
            'required' => 'No file selected'
        ]);

        $path = $request->file('excel_file')->store('files');

        $bcc_zones = Excel::load(Storage::path($path), function ($reader) {
            $reader->all();
        })->get();


        if($error = BccZone::validateHeadings($bcc_zones->getheading())) {
            Storage::delete($path);
            return back()->withErrors($error);
        }

        // pathinfo($request->file('excel_file')->getClientOriginalName(), PATHINFO_FILENAME

        $type = 'BCC_ZONE';
        $file = UploadedFile::create([
            'name' => nameFile($type),
            "path" => $path,
            'type' => $type,
            'status' => 'PROCESSING'
        ]);

        BccZoneBulkUpload::dispatch($bcc_zones, $file)->delay(now()->addSecond(3))->onQueue('high');

        alert()->success("File Uploaded", "Great Job!");

        return redirect()->route('uploaded-files.index');
    }

    public function audits(BccZone $bcc_zone) {
        $audits = $bcc_zone->audits()->latest()->get();
        $translation = 'bcc_zone';
        $model = BccZone::class;
        $title = "Audit Trail Report for BCC Zone <strong>{$bcc_zone->name}</strong>";
        $heading = "BCC Zone Audit Trail Report <small>[{$bcc_zone->name}]</small>";
        return view('admin.reports.audits.show', compact('audits', 'translation', 'model', 'title', 'heading'));
    }

    public function exportAll($type) {
        $this->export(NULL, $type);
    }


    public function export($id, $type) {
        if(!in_array($type, ['csv', 'xls', 'xlsx'])) return back()->withErrors('File type not allowed');


        if(is_null($id)){
            $bcc_zones = BccZone::setEagerLoads([]);
            $file_name = date('Y_m_d_') . time();
        } else {
            $uploaded_file = UploadedFile::findOrFail($id);
            $file_name = $uploaded_file->name;
            $bcc_zones = $uploaded_file->bcc_zones();
        }

        $bcc_zones = $bcc_zones->get()->toArray();

        $ignore_headers = ['id', 'uploaded_file_id', 'status'];

        Excel::create($file_name, function ($excel) use ($bcc_zones, $ignore_headers) {
            $excel->sheet('Bcc Zones', function ($sheet) use ($bcc_zones, $ignore_headers) {
                $result = [];
                foreach ($bcc_zones AS $k => $bcc_zone) {
                    foreach ($bcc_zone AS $key => $value) {
                        if(in_array($key, $ignore_headers)) continue;

                        $result[$k]['S/N'] = $k + 1;

                        if($key === "streets") {
                            $result[$k]['Streets'] = implode(", ", $value);
                            continue;
                        }

                        if($key === "status_text") {
                            $result[$k]['Status'] = $value;
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
}
