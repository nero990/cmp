<?php

namespace App\Http\Controllers;

use App\BccZone;
use App\Family;
use App\UploadedFile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UploadedFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploaded_files = UploadedFile::latest()->withCount('families', 'bcc_zones')->paginate(getPaginateSize());
        return view('admin.uploaded_files.index', compact('uploaded_files'));
    }

    /**
     * Display the specified resource.
     *
     * @param UploadedFile $uploaded_file
     * @return Factory|View
     */
    public function show(UploadedFile $uploaded_file)
    {
        switch ($uploaded_file->type) {
            case "FAMILY" :
                $families = $uploaded_file->families()->with('head')->orderBy('name')->paginate(getPaginateSize());
                $required_fields = Family::getRequiredHeadingsAsString();
                return view('admin.families.index', compact('families', 'required_fields'));
            case "BCC_ZONE" :
                $bcc_zones = $uploaded_file->bcc_zones()->paginate(getPaginateSize());
                $required_fields =  BccZone::getRequiredHeadingsAsString();
                return view('admin.bcc_zones.index', compact('bcc_zones', 'required_fields'));
            default:
                throw new NotFoundHttpException();
        }
    }

    public function report(UploadedFile $uploaded_file) {
        return view('admin.uploaded_files.report', compact('uploaded_file'));
    }
}
