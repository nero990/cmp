<?php

namespace App\Http\Controllers;

use App\ChurchEngagement;
use Illuminate\Http\Request;

class ChurchEngagementController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|unique:church_engagements,name',
    ];
    private $messages = ['name.unique' => 'A Church engagement with this name already exist.'];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $church_engagements = ChurchEngagement::withCount('members')->get();
        return view('admin.church_engagements.index', compact('church_engagements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.church_engagements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules, $this->messages);

        ChurchEngagement::create($request->all());

        $title = "Great Job!";
        $message = 'Church engagement created';

        if($request->wantsJson()) { return response()->json(['message' => $message, "title" => $title]); }

        alert()->success($message, $title);

        return redirect()->route('church-engagements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ChurchEngagement $church_engagement
     * @return \Illuminate\Http\Response
     */
    public function edit(ChurchEngagement $church_engagement)
    {
        return view('admin.church_engagements.edit', compact('church_engagement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ChurchEngagement $church_engagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChurchEngagement $church_engagement)
    {
        $this->rules['name'] .= ",{$church_engagement->id}";
        $request->validate($this->rules, $this->messages);

        $church_engagement->update($request->all());
        $title = "Success!";
        $message = 'Church engagement updated.';

        if($request->wantsJson()) return response()->json(['message' => $message, "title" => $title]);

        alert()->success($message, $title);

        return redirect()->route('bcc-zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function audits(ChurchEngagement $church_engagement) {
        $audits = $church_engagement->audits()->latest()->get();
        $translation = 'church_engagement';
        $model = ChurchEngagement::class;
        $title = "Audit Trail Report for the Church Engagement <strong>{$church_engagement->name}</strong>";
        $heading = "Church Engagement Audit Trail Report <small>[{$church_engagement->name}]</small>";
        return view('admin.reports.audits.show', compact('audits', 'translation', 'model', 'title', 'heading'));
    }
}
