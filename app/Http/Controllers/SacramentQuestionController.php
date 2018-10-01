<?php

namespace App\Http\Controllers;

use App\SacramentQuestion;
use Illuminate\Http\Request;

class SacramentQuestionController extends Controller
{
    private $rules = [
        'question' => 'required|min:2|unique:sacrament_questions,question',
        'status' => 'nullable|in:0,1',
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

        $data = $request->all();
        $data['status'] = empty($data['status']) ? '0' : $data['status'];
        SacramentQuestion::create($data);

        $title = "Great Job!";
        $message = "Sacrament question created";

        if($request->wantsJson()) return response()->json(['message' => $message, 'title' => $title]);

        alert()->success($message, $title);
        return redirect()->route('sacrament-questions.index');
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

        $data = $request->all();
        $data['status'] = empty($data['status']) ? '0' : $data['status'];
        $sacrament_question->update($data);

        $title = "Success!";
        $message = 'Sacrament question updated';

        if($request->wantsJson()) return response()->json(['message' => $message, 'title' => $title]);

        alert()->success($message, $title);

        return redirect()->route('sacrament-questions.index');
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

    public function audits(SacramentQuestion $sacrament_question) {
        $audits = $sacrament_question->audits()->latest()->get();
        $translation = 'sacrament_question';
        $model = SacramentQuestion::class;
        $title = "Audit Trail Report for <strong>{$sacrament_question->question}</strong>";
        $heading = "Sacrament Question Audit Trail Report <small>[{$sacrament_question->question}]</small>";
        return view('admin.reports.audits.show', compact('audits', 'translation', 'model', 'title', 'heading'));
    }
}
