<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
//        $items = $user->products;
        $items = Item::where('user_id', $user->id)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        //1 вариант
//        $archives = DB::table('items')
//            ->where('user_id', $user->id)
//            ->where('srok', '>', date('Y-m-d H:i:s'))
//            ->get();
        //2 вариант
        $itemsArchives = Item::where('user_id', $user->id)
            ->where('srok', '<', date('Y-m-d H:i:s'))
            ->get();
        return view('profile_page', compact('user', 'categories', 'brands', 'items', 'itemsArchives'));
    }


    public function profilePage2(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::where('user_id', $user->id)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $itemsArchives = Item::where('user_id', $user->id)
            ->where('srok', '<', date('Y-m-d H:i:s'))
            ->get();
        return view('profile_page2', compact('user', 'categories', 'brands', 'items', 'itemsArchives'));
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
