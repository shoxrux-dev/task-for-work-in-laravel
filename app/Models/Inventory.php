<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $fillable = [
        'product_id',
        'product_qty',
        'total_entry_price',
        'total_selling_price',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
