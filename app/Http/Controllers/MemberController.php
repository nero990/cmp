<?php

namespace App\Http\Controllers;

use App\Family;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Family $family
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        return view('admin.members.create', compact('family'));
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
