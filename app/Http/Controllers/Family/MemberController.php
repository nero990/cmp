<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Http\Controllers\Controller;
use App\Member;
use App\SacramentDetail;
use App\SacramentQuestion;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function autoComplete(Request $request) {
        $term = $request->get('term');

        $members = Member::where('first_name', 'LIKE', "%{$term}%")
            ->orWhere('middle_name', 'LIKE', "%{$term}%")
            ->orWhere('last_name', 'LIKE', "%{$term}%")
            ->selectRaw("id AS value, CONCAT(first_name,' ', middle_name, ' ', last_name, ' (', occupation, ')') AS label ")
            ->take(10)->get();

        return response()->json($members);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Family $family
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $age_group_list = Member::AGE_GROUP_LIST;
        $marital_status_list = Member::MARITAL_STATUS_LIST;
        $sacrament_question_list = SacramentQuestion::pluck('question', 'id');

        return view('admin.members.create', compact('family', 'age_group_list', 'marital_status_list', 'sacrament_question_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Family $family
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Family $family)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
