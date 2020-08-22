<?php

namespace App\Http\Controllers;

use App\filepdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {   
        $files = filepdf::all();
        return view('file', compact('files'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $fileNameExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $fileName. '_' .Carbon::now(). '.' .$extension;
            $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
            // $path = Storage::putFileAs(
            //     'public/files', $request->file('file'), $fileNameToStore
            // );
        }

        $file = new filepdf;
        $file->name = $request->input('name');
        if ($request->hasFile('file')) {
            $file->file =  $fileNameToStore;
        }else{
            $file->file =  'none';
        }

        // dd($file);
        $file->save();
        return redirect()->route('index')->with('success', 'Succeedd');
    }
}
