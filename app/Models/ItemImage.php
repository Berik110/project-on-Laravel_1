<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'item_id'];

    /*смотри в ItemController строка 51*/
//    public function getUrlAttribute($url){
//        return '/'.$url;
//    }
}
