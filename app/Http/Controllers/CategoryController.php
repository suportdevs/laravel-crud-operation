<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Category::all();
        // $category = DB::table('categories')->get();
        $category = Category::latest()->paginate(5);
        // $category = DB::table('categories')
        //                     ->join('users', 'categories.user_id', 'users.id')
        //                     ->select('categories.*', 'users.name')
        //                     ->latest()->paginate(5);
        return view('backend.category.index', compact('category'));
    }
    public function add()
    {
        return view('backend.category.add');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'The Category name is Fillable.',
        ]);

        // Category::insert([
        //     'user_id' => Auth::user()->id,
        //     'category_name' => $request->category_name,
        //     'slug' => Str::slug($request->category_name, '-'),
        //     'description' => $request->description,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category();
        // $category->user_id = Auth::user()->id;
        // $category->category_name = $request->category_name;
        // $category->slug = Str::slug($request->category_name, '-');
        // $category->description = $request->description;
        // $category->save();

        $data = array();
        $data['user_id'] = Auth::user()->id;
        $data['category_name'] = $request->category_name;
        $data['slug'] = Str::slug($request->category_name, '-');
        $data['description'] = $request->description;
        DB::table('categories')->insert($data);

        return Redirect()->route('all.category')->with('status', 'Category Created Successfull.');
    }
    public function edit($id)
    {
        // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('backend.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        // Category::find($id)->update([
        //     'user_id' => Auth::user()->id,
        //     'category_name' => $request->category_name,
        //     'slug' => Str::slug($request->category_name, '-'),
        //     'description' => $request->description,
        //     'updated_at' => Carbon::now()
        // ]);
        $data = array();
        $data['user_id'] = Auth::user()->id;
        $data['category_name'] = $request->category_name;
        $data['slug'] = Str::slug($request->category_name, '-');
        $data['description'] = $request->description;
        $data['updated_at'] = Carbon::now();
        DB::table('categories')->where('id', $id)->update($data);
        return Redirect()->route('all.category')->with('status', 'Category Updated Successfull.');
    }
    public function softDelete($id)
    {
        Category::find($id)->delete();
        return Redirect()->back()->with('status', 'Category temporary Deleted Successfull.');
    }
    public function trashList()
    {
        $trashed = Category::onlyTrashed()->paginate(5);
        return view('backend.category.trashList', compact('trashed'));
    }
    public function restore($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('status', 'The Category Restored Successfull.');
    }
    public function forceDelete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('status', 'The Category Permanently Deleted Successfull.');
    }
}
