<?php

namespace App\Http\Controllers;

use App\SacramentQuestion;
use Illuminate\Http\Request;

class SacramentQuestionController extends Controller
{
    private $rules = [
        'question' => 'required|min:2|unique:sacrament_questions,question',
    ];
    private $messages = ['name.unique' => 'A Sacrament detail with this question already exist.'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sacrament_questions = SacramentQuestion::all();
        return view('admin.sacrament_questions.index', compact('sacrament_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sacrament_questions.create');
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
        SacramentQuestion::create($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Sacrament question created successfully']);

        flash()->success("Success! Sacrament question created");
        return redirect()->route('sacrament-questions.index');
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
     * @param SacramentQuestion $sacrament_question
     * @return \Illuminate\Http\Response
     * @internal param SacramentQuestion $sacrament_detail
     */
    public function edit(SacramentQuestion $sacrament_question)
    {
        return view('admin.sacrament_questions.edit', compact('sacrament_question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param SacramentQuestion $sacrament_question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SacramentQuestion $sacrament_question)
    {
        $this->rules['question'] .= ",{$sacrament_question->id}";
        $request->validate($this->rules, $this->messages);

        $sacrament_question->update($request->all());
        if($request->wantsJson()) return response()->json(['message' => 'Sacrament question updated successfully']);

        return redirect()->route('sacrament-questions.index')->with(['message' => 'Sacrament question updated successfully']);
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
