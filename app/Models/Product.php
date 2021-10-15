<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function cart(){
        return $this->hasOne('App\Models\Cart');
    }
    protected $table="products";
    protected $fillable = [
        'product',
        'image',
        'price',
        'category',
        'status',
        'description'
    ];
}
