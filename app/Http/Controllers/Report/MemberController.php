<?php

namespace App\Http\Controllers\Report;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index() {
        $status = request()->status;

        $members = Member::setEagerLoads([]);
        switch ($status) {
            case "all" :
                break;
            case "deceased" :
                $members =  $members->deceased();
                break;
            default:
                $members = $members->living();
                $status = "living";
        }

        $status = ucfirst($status);
        $members = $members->orderBy('first_name', 'ASC')->orderBy('middle_name', 'ASC')->orderBy('last_name', 'ASC')->paginate(getPaginateSize());

        return view('admin.reports.members.index', compact('members', 'status'));
    }
}
