<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\Family;
use App\Member;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members_count = Member::living()->count();
        $deceased_members_count = Member::deceased()->count();
        $all_members_count = Member::count();

        $living_members_percentage = round(($members_count / $all_members_count) * 100, 0);
        $deceased_members_percentage = round(($deceased_members_count / $all_members_count) * 100, 0);

        $families_count = Family::family()->whereHas('members', function ($query) {
            $query->living();
        })->count();

        $individuals_count = Family::individual()->whereHas('members', function ($query) {
            $query->living();
        })->count();

        $children_count = count(array_merge(...Family::family()->whereNotNull('names_of_children')->pluck('names_of_children', 'id')->toArray()));

        $bcc_zones = BccZone::active()->withCount('families')->orderBy('families_count', 'desc')->get();

        return view('admin.home', compact('families_count', 'members_count', 'bcc_zones', 'individuals_count', 'children_count', 'living_members_percentage', 'deceased_members_percentage'));
    }
}
