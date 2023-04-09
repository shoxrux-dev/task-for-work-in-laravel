<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryProduct extends Model
{
    use HasFactory;
    protected $table = 'entry_products';
    protected $fillable = [
        'product_id',
        'entry_price',
        'entry_count',
        'selling_price',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
