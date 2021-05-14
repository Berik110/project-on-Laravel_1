<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use App\Http\Requests\ValidateImgStore;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Region;
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
        $regions = Region::all();
        return view('addadvert', compact('categories', 'brands', 'user', 'regions'));
    }

    public function storeAdd(AddItemRequest $req, ValidateImgStore $request)
    {
        $item = Item::create($req->all());

        if ($request->file('url')){
            $file = $request->file('url');
            $path = '/images/'.$file->getClientOriginalName();
            $file->move('images/', $file->getClientOriginalName());

            ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);
        }
        /* было так */
//        $file = $request->file('advImage');
//        $path = '/images/'.$file->getClientOriginalName();
//        $file->move('images/', $file->getClientOriginalName());
//
//        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);
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
