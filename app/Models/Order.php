<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'product_id',
        'product_qty',
        'total_price',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function getOrdersOfLastDay(){
        return Order::where('created_at', '>=', now()->subDay())->get();
    }

    public static function getTotalPriceOfLastDay(){
        return Order::where('created_at','>=',now()->subDay())->sum('total_price');
    }

    public static function getOrdersByDate($date){
        return Order::whereDate('created_at', $date)->get();
    }
}
