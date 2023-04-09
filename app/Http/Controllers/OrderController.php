<?php

namespace App\Http\Controllers;

use App\Models\EntryProduct;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('order.index', ['order' => $order]);
    }

    public function create()
    {
        $product = Product::all();
        return view('order.create', ['product' => $product]);
    }

    public function upload(Request $request)
    {
        $order = new Order();

        $productId = $request->product_id;
        $productQty = $request->product_qty;

        $order['product_id'] = $productId;
        $order['product_qty'] = $productQty;

        $product = Product::where('id', $productId)->first();
        $order['total_price'] = $productQty * $product->selling_price;

        if (Inventory::where('product_id', $productId)->exists()) {

            $entryProduct = EntryProduct::where('product_id', $productId)->latest('created_at')->first();

            $inventory = Inventory::where('product_id', $productId)->first();
            $inventory['product_qty'] -= $productQty;
            $inventory['total_entry_price'] -= $entryProduct->entry_price;
            $inventory['total_selling_price'] -= $entryProduct->selling_price;
            $inventory->update();
        }

        $order->save();
        return redirect()->route('order');
    }


    public function search(Request $request)
    {
        $order = Order::getOrdersByDate($request->date);
        return view('order.search', ['order' => $order]);
    }


}
