<?php

namespace App\Http\Controllers\ChurchEngagement;

use App\ChurchEngagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(ChurchEngagement $church_engagement)
    {
        $members = $church_engagement->members;
        return view('admin.church_engagements.members', compact('members', 'church_engagement'));
    }

    public function store(ChurchEngagement $church_engagement) {

    }
}
