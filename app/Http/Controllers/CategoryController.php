<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.index', ['category' => $category]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function upload(Request $request)
    {
        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('uploads/category',$fileName);
            $category['image'] = $fileName;
        }
        $category['name'] = $request->name;
        $category->save();
        return redirect()->route('category');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if($request->hasFile('image')){
            $path =public_path().'/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category',$filename);
            $category['image'] = $filename;
        }
        $category['name'] = $request->name;
        $category->update();
        return redirect()->route('category');
    }

    public function delete($id){
        $category = Category::find($id);
        $path = public_path().'/uploads/category/'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();
        return redirect()->route('category');
    }
}
