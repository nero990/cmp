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
        $message = 'Church engagement created successfully';
        flash()->success($message);

        if($request->wantsJson()) { return response()->json(['message' => $message]); }

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
        if($request->wantsJson()) return response()->json(['message' => 'Church engagement updated successfully']);

        return redirect()->route('bcc-zones.index')->with(['message' => 'Church engagement updated successfully']);
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
}
