<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('backend.brands.index', compact('brands'));
    }
    public function add()
    {
        return view('backend.brands.add');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_img' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => "Brand Field must be Fillable",
            'brand_min' => 'Brand must be upper 4 Letter',
        ]);

        $brand_img = $request->file('brand_img');
        // $img_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_img->getClientOriginalExtension());
        // $img_name = $img_gen.'.'.$img_ext;
        // $img_path = 'image/brands/';
        // $final_img = $img_path.$img_name;
        // $brand_img->move($img_path,$img_name);
        $img_gen = hexdec(uniqid()).'.'.$brand_img->getClientOriginalExtension();
        Image::make($brand_img)->resize(300,200)->save('image/brands/'.$img_gen);
        $final_img = 'image/brands/'.$img_gen;

        Brand::insert([
            'user_id' => Auth::user()->id,
            'brand_name' => $request->brand_name,
            'brand_img' => $final_img,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('all.brands')->with('status', 'Brand Inserted Successfull.');
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('backend.brands.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
        [
            'brand_name.required' => 'The Brand Name Must be Fillable.',
            'brand_name.min' => 'The Brand Name must be 4 Characters',
        ]);

        $brand = Brand::find($id);

        if($request->file('brand_img') != ''){

            //code for remove old file
            if($brand->brand_img != '' && $brand->brand_img != null){
                $file_old = $brand->brand_img;
                unlink($file_old);
            }

            //upload new file
            $file = $request->file('brand_img');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        //   $file->move($path, $filename);
            Image::make($file)->resize(300,200)->save('image/brands/'.$filename);
            $final_img = 'image/brands/'.$filename;

            //for update in table
            $brand->update([
                'user_id' => Auth::user()->id,
                'brand_name' => $request->brand_name,
                'brand_img' => $final_img,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);

            return Redirect()->route('all.brands')->with('status', 'Brand Inserted Successfull.');

        }else {
            $brand->update([
                'user_id' => Auth::user()->id,
                'brand_name' => $request->brand_name,
                'description' => $request->description,
                'updated_at' => Carbon::now()
            ]);
            return Redirect()->route('all.brands')->with('status', 'Brand Inserted Successfull.');
        }
    }

    public function delete($id)
    {        
        Brand::find($id)->delete();
        return Redirect()->back()->with('status', 'Brand Deleted Successfull.');
    }

    public function trashList()
    {
        $trashed = Brand::onlyTrashed()->paginate(5);
        return view('backend.brands.trashList', compact('trashed'));
    }

    public function forceDelete($id) 
    {
        $brand = Brand::onlyTrashed()->find($id);
        
        $old_img = $brand->brand_img;
        unlink($old_img);
        Brand::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('status', 'The Brand Permanently Deleted Successfull.');
    }
}
