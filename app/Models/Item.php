<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name', 'year', 'description', 'price', 'option_id', 'rent_id', 'brand_id', 'category_id', 'city_id', 'user_id', 'srok'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function itemByUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_products', 'item_id', 'order_id');
    }

    public function images(){
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id'); // Many to One
    }

    public function rental(){
        return $this->belongsTo(Rent::class, 'rent_id'); // Many to One
    }

}
