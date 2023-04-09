<?php

namespace App\Http\Controllers;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index(){
        $order = Order::getOrdersOfLastDay();
        $totalPriceOfLastDay = Order::getTotalPriceOfLastDay();
        return view('dashboard', ['order' => $order, 'total_price' => $totalPriceOfLastDay]);
    }
}
