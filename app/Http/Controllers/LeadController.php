<?php

namespace App\Http\Controllers;


use App\Exports\ExportFailures;
use App\Imports\LeadImportValidation;
use App\Imports\LeadsImport;
use App\Models\Lead;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public $erroredRecords = 0;
    public $proceed = false;

    public function index(){
        $leads = Lead::all();
        return Inertia::render('Leads/Listing', ['leads' => $leads,]);
    }

    public function upload(){
        return Inertia::render('Leads/Upload',['proceed' => false,'fn' => 'submit']);
    }
    public function import(Request $request){
        $request->validate([
            'upload_file' => 'required|mimes:csv|max:2048'
        ]);

        $document = $request->file('upload_file')->store('csv');

        try {
            Excel::import(new LeadImportValidation(), $document);
        } catch (\Exception $exception) {
            $this->erroredRecords = count($exception->errors());
        }

        return Inertia::render('Leads/Proceed', ['erroredRecords' => $this->erroredRecords, 'showProceedBox' => true, 'proceed' => true, 'upload_file' => $document]);

    }

    public function proceed(Request $request){

       (new LeadsImport(auth()->user(), 10))->import($request->input('upload_file'), 'local', \Maatwebsite\Excel\Excel::CSV);


        return Inertia::render('Leads/Upload',['success' => 'All good!']);
//        return redirect('/')->with('success', 'All good!');
    }



}
