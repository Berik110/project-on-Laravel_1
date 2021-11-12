<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use App\Http\Requests\ValidateImgStore;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Option;
use App\Models\Region;
use App\Models\Rent;
use Carbon\Carbon;
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
        return view('home1', compact('categories', 'items'));
    }

    public function addAdvPage()
    {
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $regions = Region::all();
        $options = Option::all();
        $rents = Rent::all();
        return view('addadvert', compact('categories', 'brands', 'user', 'regions', 'options', 'rents'));
    }

    public function storeAdd(AddItemRequest $req, ValidateImgStore $request)
    {
//        $item = Item::create($req->all());
        $item = new Item();
        $item->name = $request->get("name");
        $item->year = $request->get("year");
        $item->description = $request->get("description");
        $item->price = $request->get("price");
        $item->option_id = $request->get("option_id");
        $item->rent_id = $request->get("rent_id");
        $item->brand_id = $request->get("brand_id");
        $item->category_id = $request->get("category_id");
        $item->city_id = $request->get("city_id");
        $item->user_id = $request->get("user_id");
        $item->srok = date("Y-m-d H:i:s", time()+ 60*60*24*14);
        $item->save();

        /* 1 вариант  - было так согласно курсу */
//        $file = $request->file('url'); Достаем файл с request
//        $path = '/images/'.$file->getClientOriginalName(); это путь
//        $file->move('images/', $file->getClientOriginalName()); переместила файл в images
//
//        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);

        /* 2 вариант */
        if ($request->hasFile('url')){
            $folder = date('Y-m-d');
            $path = $request->file('url')->store("images/{$folder}", "public");
        }
        ItemImage::create(['url'=>$path ?? null, 'item_id'=>$item->id]); // $path ? $path : null

//        return redirect('/advertpage?succes=1'); сперва сделал так
        /* а потом сделал так */
//        return back()->with('success', 'Ваше объявление опубликовано!');
        return redirect()->route('profile')->with('success', 'Ваше объявление опубликовано!');

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
