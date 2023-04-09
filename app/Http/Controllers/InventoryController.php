<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
        $inventory = Inventory::all();
        $total_price = Inventory::sum('total_selling_price');
        return view('inventory.index', ['inventory' => $inventory, 'total_price' => $total_price]);
    }

}
