<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('product.index', ['product' => $product]);
    }

    public function create(){
        $category = Category::all();
        return view('product.create', ['category' => $category]);
    }

    public function upload(Request $request){
        $product = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('uploads/product',$fileName);
            $product['image'] = $fileName;
        }
        $product['name'] = $request->name;
        $product['description'] = $request->description;
        $product['discount'] = 0;
        $product['selling_price'] = $request->selling_price;
        $product['category_id'] = $request->category_id;

        $product->save();
        return redirect()->route('product');
    }

    public function edit($id){
        $product = Product::find($id);
        $category = Category::all();
        return view('product.edit', ['product' => $product, 'category' => $category]);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if($request->hasFile('image')){
            $path = public_path().'/uploads/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/product',$filename);
            $product['image'] = $filename;
        }
        $product['name'] = $request->name;
        $product['description'] = $request->description;
        $product['selling_price'] = $request->selling_price;
        $product['discount'] = $request->discount;
        $product['category_id'] = $request->category_id;
        $product->update();
        return redirect()->route('product');
    }

    public function delete($id){
        $product = Product::find($id);
        $path = public_path().'/uploads/product/'.$product->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $product->delete();
        return redirect()->route('product');
    }

}
