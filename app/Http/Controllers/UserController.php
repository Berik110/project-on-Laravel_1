<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = $user->products;
        return view('profile_page', compact('user', 'categories', 'brands', 'items'));
    }

    public function settingPage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::all();
        $password = Hash::make($user->password);
        return view('setting_page', compact('user', 'categories', 'brands', 'items', 'password'));
    }

    public function settingSavePage(Request $request){
        User::where('id', $request->id)->update($request->except('id', '_method', '_token', 'password'));
        $user = Auth::user();
        return view('setting_page', compact('user'));
    }
}
