<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'image',
        'description',
        'discount',
        'category_id',
        'selling_price',
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id','category_id');
    }

    public function entry(){
        return $this->hasMany(EntryProduct::class, 'product_id', 'id');
    }

    public function inventory(){
        return $this->hasOne(Inventory::class, 'product_id', 'id');
    }

}
