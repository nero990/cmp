<?php

namespace app\Custom\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait Bread {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bcc_zones = Model::all();
        return view('admin.bcc_zones.index', compact('bcc_zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bcc_zones.create');
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

        Model::create($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Bcc zone created successfully']);

        return redirect()->route('bcc-zones.index')->with(['message' => 'Bcc zone created successfully']);
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
     * @param BccZone $bcc_zone
     * @return \Illuminate\Http\Response
     */
    public function edit(BccZone $bcc_zone)
    {
        return view('admin.bcc_zones.edit', compact('bcc_zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BccZone $bcc_zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BccZone $bcc_zone)
    {
        $this->rules['name'] .= ",{$bcc_zone->id}";
        $request->validate($this->rules, $this->messages);

        $data = $request->all();
        $data['status'] = isset($data['status']) ? '1' : '0';
        $bcc_zone->update($data);
        if($request->wantsJson()) return response()->json(['message' => 'Bcc zone updated successfully']);

        return redirect()->route('bcc-zones.index')->with(['message' => 'Bcc zone updated successfully']);
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