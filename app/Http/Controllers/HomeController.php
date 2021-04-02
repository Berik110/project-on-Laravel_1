<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'addAdvPage', 'storeAdd');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('home', compact('categories', 'items'));
    }

    public function addAdvPage()
    {
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        return view('addadvert', compact('categories', 'brands', 'user'));
    }

    public function storeAdd(AddItemRequest $request)
    {
        $item = Item::create($request->all());
        $file = $request->file('advImage');
        $path = '/images/'.$file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);
        return redirect('/advertpage?succes=1');


//        мульти загрузка - работает
//        $item = Item::create($request->all());
//        if ($request->advImage){
//            $folder = date('Y-m-d');
//            foreach ($request->advImage as $photo) {
//                $filename = $photo->store("images/{$folder}", 'public');
//                ItemImage::create(['url'=>$filename, 'item_id'=>$item->id]);
//            }
//            return redirect('/advertpage?succes=1');
//        }

    }

}
