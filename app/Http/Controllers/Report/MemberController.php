<?php

namespace App\Http\Controllers\Report;

use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
        $members = $members->with('family')->globalSearch(['first_name', 'middle_name', 'last_name'])->orderBy('first_name', 'ASC')->orderBy('middle_name', 'ASC')->orderBy('last_name', 'ASC')->paginate(getPaginateSize());

        return view('admin.reports.members.index', compact('members', 'status'));
    }


    public function export($type) {
        if(!in_array($type, ['csv', 'xls', 'xlsx'])) return back()->withErrors('File type not allowed');


        $members = Member::with('role');
        $file_name = date('Y_m_d_') . time();

        switch(\request()->get('filter')) {
            case "all" :
                break;
            case "deceased" :
                $members = $members->deceased();
                break;
            default :
                $members = $members->living();
        }

        $members = $members->orderBy('first_name')->get()->toArray();

        $ignore_headers = ['id', 'uploaded_file_id', 'state_id', 'bcc_zone_id', 'type', 'family_id', 'card_status', 'member_role_id'];

        Excel::create($file_name, function ($excel) use ($members, $ignore_headers) {
            $excel->sheet('Families', function ($sheet) use ($members, $ignore_headers) {
                $result = [];
                foreach ($members AS $k => $member) {
                    foreach ($member AS $key => $value) {
                        if(in_array($key, $ignore_headers)) continue;

                        $result[$k]['S/N'] = $k + 1;

                        if($key === 'marital_status_text') {
                            $result[$k]['Marital Status'] = $value;
                            continue;
                        }

                        if($key === 'age_group_text') {
                            $result[$k]['Age Group'] = $value;
                            continue;
                        }

                        if($key === 'phones') {
                            $result[$k]['Phones'] = implode(", ", $value);
                            continue;
                        }

                        if($key === 'status_text') {
                            $result[$k]['Status'] = $value;
                            continue;
                        }

                        if($key === 'role') {
                            $result[$k]['Role'] = $value['name'];
                            continue;
                        }

                        if($key === 'family') {
                            $result[$k]['Family Name'] = $value['name'];
                            continue;
                        }

                        $result[$k][normal_case($key)] = $value;

                    }
                }
                $sheet->fromArray($result);
                $sheet->row(1, function ($row) {
                    $row->setBackground('#000000');
                    $row->setFontColor('#00FF00');
                    $row->setFontWeight('bold');
                });
            });
        })->download($type);

        return false;
    }

}
