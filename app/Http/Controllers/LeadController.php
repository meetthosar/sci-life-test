<?php

namespace App\Http\Controllers;

use App\Imports\LeadsImport;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function index(){
        $leads = Lead::all();
        return Inertia::render('Leads/Listing', ['leads' => $leads]);
    }

    public function upload(){
        return Inertia::render('Leads/Upload');
    }
    public function import(Request $request){
        $request->validate([
            'upload_file' => 'required|mimes:csv|max:2048'
        ]);

        (new LeadsImport)->import($request->file('upload_file'), 'local', \Maatwebsite\Excel\Excel::CSV);
//        dd((new LeadsImport())->toArray($request->file('upload_file'), null, \Maatwebsite\Excel\Excel::CSV));
//        (new LeadsImport())->queue($request->file('upload_file'), null, \Maatwebsite\Excel\Excel::CSV);

//        Excel::import(new LeadsImport, $request->input('upload_file'), 'local', \Maatwebsite\Excel\Excel::CSV);

        return redirect('/')->with('success', 'All good!');
    }
}
