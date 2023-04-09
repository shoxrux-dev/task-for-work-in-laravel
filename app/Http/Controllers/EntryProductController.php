<?php

namespace App\Http\Controllers;

use App\Models\EntryProduct;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class EntryProductController extends Controller
{
    public function index(){
        $product = Product::all();
        $entryProduct = EntryProduct::all();
        return view('entry-product.index', ['product' => $product, 'entry_product' => $entryProduct]);
    }

    public function create(){
        $product = Product::all();
        return view('entry-product.create', ['product' => $product]);
    }

    public function upload(Request $request){
        $entryProduct = new EntryProduct();

        $productId = $request->product_id;
        $entryCount = $request->entry_count;
        $entryPrice = $request->entry_price;
        $sellingPrice = $request->selling_price;

        $entryProduct['product_id'] = $productId;
        $entryProduct['entry_price'] = $entryPrice;
        $entryProduct['entry_count'] = $entryCount;
        $entryProduct['selling_price'] = $sellingPrice;

        if($sellingPrice > 1){
            $product = Product::where('id', $productId)->first();
            $product['selling_price'] = $sellingPrice;
            $product->update();
        }

        if(Inventory::where('product_id', $productId)->exists()) {
            $inventory = Inventory::where('product_id', $productId)->first();
            $inventory['product_qty'] += $entryCount;
            $inventory['total_entry_price'] += $entryCount*$entryPrice;
            $inventory['total_selling_price'] += $entryCount*$sellingPrice;
            $inventory->update();
        }else{
            $newInventory = new Inventory();
            $newInventory['product_id'] = $productId;
            $newInventory['product_qty'] = $entryCount;
            $newInventory['total_entry_price'] = $entryCount*$entryPrice;
            $newInventory['total_selling_price'] = $entryCount*$sellingPrice;
            $newInventory->save();
        }

        $entryProduct->save();
        return redirect()->route('entry-product');
    }

    public function edit($id){
        $entryProduct = EntryProduct::find($id);
        $product = Product::all();
        return view('entry-product.edit', ['entry_product' => $entryProduct, 'product' => $product]);
    }

}
