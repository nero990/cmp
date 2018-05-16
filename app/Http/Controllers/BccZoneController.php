<?php

namespace App\Http\Controllers;

use App\BccZone;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bcc_zones = BccZone::all();
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

        BccZone::create($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Bcc zone created successfully']);

        return redirect()->route('bcc-zones.index')->with(['message' => 'Bcc zone created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param BccZone $bcc_zone
     * @return \Illuminate\Http\Response
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
