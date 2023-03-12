<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload()
    {
        return view('upload');
    }
    public function store(Request $request)
    {
        $request->validate([
        //    'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $file   = request()->file('image')->hashName(); //This is to get the extension of the image file just uploaded
            $image_name = $file;
            $path = $request->file('image')->storeAs(
                'images',
                $image_name,
                's3'
            );
            // Image::create([
            //     'title'=>$request->title,
            //     'image'=>$path
            // ]);
            // return redirect()->back()->with([
            //     'message'=> "Image uploaded successfully",
            // ]);
            $s3 = Storage::disk('s3');
            return redirect()->to($s3->url($path));
     }
    }
}
