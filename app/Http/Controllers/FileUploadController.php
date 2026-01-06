<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        try{
            $request->validate([
                'file' => 'required|file|max:10240', // 10MB max
            ]);
            
            if ($request->hasFile('file')) {
                // $file = $request->file('file');
                // $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                
                $path = Storage::disk('s3')->put('uploads', $request->file('file'));

                Log::info('File uploaded successfully: ' . $path);

            return back()
                ->with('success', 'File uploaded successfully')
                ->with('file', $path);
            }
            return back()->with('error', 'No file selected');
        }
        catch(Exception $e){
            Log::error('File upload failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload file: ' . $e->getMessage());
        }
      

        

        
    }
}
