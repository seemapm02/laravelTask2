<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\files;
use Illuminate\Support\Facades\Storage;

class filesController extends Controller
{
    
    public function uploadFiles(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'productid'=> 'required',
            'files' => 'required',
            'files.*' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400); 
        }
 
        if ($request->file){
            foreach($request->files as $file) {
 
                $fileName = $file->getClientOriginalName();
                $filePath = 'uploads/' . $fileName;
 
                $path = Storage::disk('public')->put($filePath, file_get_contents($file));
                $path = Storage::disk('public')->url($path);
 
                // // Create files
                files::create([
                    'filename' => $fileName,
                    'productid'=>$request->productid,
                ]);
            }
        }
 
        return response()->json([
            'Success'=> 'Files Uploaded Successfully',            
        ]);
    }
}
