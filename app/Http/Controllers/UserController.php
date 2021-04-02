<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::all();
        return view('profile_page', compact('user', 'categories', 'brands', 'items'));
    }
}
