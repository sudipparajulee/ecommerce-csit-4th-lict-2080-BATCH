<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'discounted_price',
        'description',
        'category_id',
        'stock',
        'photopath'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
