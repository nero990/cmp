<?php

namespace App\Http\Controllers\Report;

use App\Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    public function index () {

        return Family::first()->audits->first();
    }

}
