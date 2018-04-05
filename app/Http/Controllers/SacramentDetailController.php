<?php

namespace App\Http\Controllers;

use App\SacramentDetail;
use Illuminate\Http\Request;

class SacramentDetailController extends Controller
{
    private $rules = [
        'question' => 'required|min:2|unique:sacrament_details,question',
    ];
    private $messages = ['name.unique' => 'A Sacrament detail with this question already exist.'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sacrament_details = SacramentDetail::all();
        return view('admin.sacrament_details.index', compact('sacrament_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response_type_list = SacramentDetail::$response_type_list;

        return view('admin.sacrament_details.create', compact('response_type_list'));
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
        SacramentDetail::create($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Sacrament detail created successfully']);

        return redirect()->route('sacrament-details.index')->with(['message' => 'Sacrament detail created successfully']);
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
     * @param SacramentDetail $sacrament_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(SacramentDetail $sacrament_detail)
    {
        $response_type_list = SacramentDetail::$response_type_list;

        return view('admin.sacrament_details.edit', compact('sacrament_detail', 'response_type_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param SacramentDetail $sacrament_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SacramentDetail $sacrament_detail)
    {
        $this->rules['question'] .= ",{$sacrament_detail->id}";
        $request->validate($this->rules, $this->messages);

        $sacrament_detail->update($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Sacrament detail updated successfully']);

        return redirect()->route('sacrament-details.index')->with(['message' => 'Sacrament detail updated successfully']);
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
