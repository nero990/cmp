<?php

namespace App\Http\Controllers\Report;

use App\Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index () {
        $audits = Audit::with('user')->latest()->paginate(getPaginateSize());

        return view('admin.reports.audits.index', compact('audits'));
    }

}
