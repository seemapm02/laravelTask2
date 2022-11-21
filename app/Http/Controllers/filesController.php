<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\files;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class filesController extends Controller
{
    
    public function uploadFiles(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'productid'=> 'required',
            'files' => 'required',
            'files.*' => 'required',
        ]);

       // print_r($request->files);


        if($validator->fails())
        {
            return response()->json($validator->errors(),400); 
        }
 
        if ($request->input('files')){

            foreach($request->input('files') as $file) {
 
               // $fileName = $file->getClientOriginalName();

                $filePath = 'uploads/' . $file;
 
                $path1 = Storage::disk('uploads')->path($filePath);
                //$path = Storage::disk('uploads')->put($filePath, file_get_contents($file));
               // $path = Storage::disk('uploads')->url($path);
 
                // // Create files
                files::create([
                    'filename' => $file,
                    'productid'=>$request->productid,
                ]);
            }
        }
 
        return response()->json([
            'Success'=> 'Files Uploaded Successfully',            
        ]);
    }
}
