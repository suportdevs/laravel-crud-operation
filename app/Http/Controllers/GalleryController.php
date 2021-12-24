<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        return view('backend.gallery.index', compact('gallery'));
    }

    public function insert(Request $request)
    {
        $images = $request->file('image');

        foreach($images as $image){
            $filename = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('image/gallery/'.$filename);
            $finalFile = 'image/gallery/'.$filename;

            Gallery::insert([
                'image' => $finalFile,
                'title' => $request->title,
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('status', 'Gallery Image Added Successful.');
    }
}
