<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use App\Http\Requests\ValidateImgStore;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Option;
use App\Models\Region;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PATH = 'admin.items.';

    public function index()
    {
        $user = Auth::user();
        $items = Item::all();
        $brands = Brand::all();
        $categories = Category::all();
        $regions = Region::all();
        $cities = City::all();
        $options = Option::all();
        $rents = Rent::all();
        return view(self::PATH .'index', compact('items', 'brands', 'categories', 'user', 'regions', 'cities', 'options', 'rents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddItemRequest $request)
    {
//        $item = Item::create($request->all());
        $item = new \stdClass();
        $item->name = $request->get('name');
        $item->year = $request->get('year');
        $item->description = $request->get('description');
        $item->price = $request->get('price');
        $item->option_id = $request->get('option_id');
        $item->rent_id = $request->get('rent_id');
        $item->brand_id = $request->get('brand_id');
        $item->category_id = $request->get('category_id');
        $item->city_id = $request->get('city_id');
        $item->user_id = $request->get('user_id');
        $item->srok = $request->get('srok');

        if ($request->hasFile('url')){
            $folder = date('Y-m-d');
            $path = $request->file('url')->store("images/{$folder}", "public");
        }
        ItemImage::create(['url'=>$path ?? null, 'item_id'=>$item->id]); // $path ? $path : null

//        $file = $request->file('itemImage');
//        $path = '/images/'.$file->getClientOriginalName();
//        $file->move('images/', $file->getClientOriginalName());
//
//        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);

        return redirect('/admin/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        $brands = Brand::all();
        $categories =Category::all();
        $regions = Region::all();
        $options = Option::all();
        $rents = Rent::all();
        return view('admin.items.show', compact('item', 'brands', 'categories', 'regions', 'options', 'rents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(AddItemRequest $request)
    {
        /*Новая версия для сохранения если много полей*/
        Item::where('id', $request->id)->update($request->except('id', '_method', '_token', 'region_id'));

        /* Сохраняем по старому */
//        $item = Item::find($request->get('id'));
//        $item->name = $request->get('name');
//        $item->description = $request->get('description');
//        $item->price = $request->get('price');
//        $item->quantity = $request->get('quantity');
//        $item->option = $request->get('option');
//        $item->category_id = $request->get('category_id');
//        $item->brand_id = $request->get('brand_id');
//        $item->save();

        return redirect('/admin/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect('/admin/item');
    }


    public function itemsByCategory(Request $request)
    {
//        $items = Item::where('category_id', $request->get('category_id'))->paginate(3); // используем этот вариант
//        $items = Item::where('category_id', $request->get('category_id'))->simplePaginate(6);
        $items = Item::where('category_id', $request->get('category_id'))
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $categories = Category::all();
        $brands = Brand::all();
        $user = Auth::user();
        $regions = Region::all();
        $cities = City::all();
        $category = Category::find($request->get('category_id'));
        $options = Option::all();

        return view('items.by_category', compact('items', 'categories', 'brands', 'user', 'regions',
            'cities', 'category', 'options'));
    }


    public function getDetails(Request $request){
        $item = Item::find($request->get('item_id'));

        return view('items.details', compact('item'));
    }

    public function option1(){
        $categories = Category::all();
        $brands = Brand::all();
//        $items = Item::where('option_id', 1)->get();
        $items = Item::where('option_id', 1)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $regions = Region::all();
        $cities = City::all();
        $user = Auth::user();
        $options = Option::all();
//        $items = Item::where('option', 1)->paginate(6);

        return view('items.by_options1', compact('items', 'categories', 'brands', 'regions', 'cities', 'user', 'options'));
    }

    public function option2(){
        $categories = Category::all();
        $brands = Brand::all();
//        $items = Item::where('option_id', 2)->get();
        $items = Item::where('option_id', 2)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $regions = Region::all();
        $cities = City::all();
        $user = Auth::user();
        $options = Option::all();
//        $items = Item::where('option', 2)->paginate(6);

        return view('items.by_options2', compact('items', 'categories', 'brands', 'regions', 'cities', 'user', 'options'));
    }

    public function option3(){
        $categories = Category::all();
        $brands = Brand::all();
//        $items = Item::where('option_id', 3)->get();
        $items = Item::where('option_id', 3)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $regions = Region::all();
        $cities = City::all();
        $user = Auth::user();
        $options = Option::all();
//        $items = Item::where('option', 2)->paginate(6);

        return view('items.by_options3', compact('items', 'categories', 'brands', 'regions', 'cities', 'user', 'options'));
    }

    public function option4(){
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::where('option_id', 4)->get();
        $regions = Region::all();
        $cities = City::all();
        $user = Auth::user();
        $options = Option::all();
//        $items = Item::where('option', 2)->paginate(6);
        return view('items.parts');
//        return view('items.by_options4', compact('items', 'categories', 'brands', 'regions', 'cities', 'user', 'options'));
    }

    public function search(Request $request){

        $category = $request->get('category_id');
        $brand = $request->get('brand_id');
        $option_id = $request->get('option_id');
        $price_from = $request->get('priceFrom');
        $price_till = $request->get('priceTill');
        $city = $request->get('city_id');
        $region = $request->get('region_id');

//       $items = Item::all();
       $items = Item::where('srok', '>', date('Y-m-d H:i:s'))
           ->get();

        if ($category){
            $items =  $items->filter(function ($item) use ($category){
                return $item->category_id==$category;
            });
        }

        if ($brand){
            $items =  $items->filter(function ($item) use ($brand){
                return $item->brand_id==$brand;
            });
        }
//        if ($name){
//            $items =  $items->filter(function ($item) use ($name){
//                return $item->name==$name;
//            });
//        }
        if ($option_id){
            $items =  $items->filter(function ($item) use ($option_id){
                return $item->option_id==$option_id;
            });
        }
        if ($price_from){
            $items =  $items->filter(function ($item) use ($price_from){
                return $item->price>=$price_from;
            });
        }
        if ($price_till){
            $items =  $items->filter(function ($item) use ($price_till){
                return $item->price<=$price_till;
            });
        }
        if ($region){
            $items =  $items->filter(function ($item) use ($region){
                return $item->city->region_id==$region;
            });
        }
        if ($city){
            $items =  $items->filter(function ($item) use ($city){
                return $item->city_id==$city;
            });
        }

        $brands = Brand::all();
        $categories = Category::all();
        $regions = Region::all();
        $cities = City::all();
        $options = Option::all();
        $user = Auth::user();
        $getParams = $request->query->all();
        return view('items.by_search', compact('categories', 'brands', 'items',
                'user', 'cities', 'regions', 'category', 'options', 'getParams'));
    }


    public function data(){
        $categories = Category::all();
        $brands = Brand::all();
        $users = User::all();
        $items = Item::all();
        $itemsActive = Item::where('srok', '>', date('Y-m-d H:i:s'))->get();
        $itemsArchives = Item::where('srok', '<', date('Y-m-d H:i:s'))->get();

        return view('admin.index', compact('items', 'categories', 'brands', 'users', 'itemsActive', 'itemsArchives'));
    }


    public function changeItem(Request $request){
        $categories = Category::all();
        $regions = Region::all();
        $brands = Brand::all();
        $item = Item::find($request->get('id'));
        $cities = City::all();
        $user = Auth::user();
        $city = City::find($request->get('city_id'));
        $options = Option::all();
        $rents = Rent::all();
        return view('items.change_item', compact('categories', 'brands', 'item', 'regions', 'cities', 'user', 'city', 'options', 'rents'));
    }

    public function deleteItem(Request $request){
        Item::destroy($request->get("item_id"));
        return redirect('/');
    }

    public function deleteItem2(Request $request){
        Item::destroy($request->get("item_id"));
        return redirect()->route('profile2');
    }

    public function updateItem(AddItemRequest $request)
    {
        /*Новая версия для сохранения если много полей*/
//        Item::where('id', $request->id)->update($request->except('id', '_method', '_token', 'region_id', 'srok'));

        /*Обычная версия для сохранения */
        $item = Item::find($request->get('id'));
        $item->city_id = $request->get("city_id");
        $item->option_id = $request->get("option_id");
        $item->rent_id = $request->get("rent_id");
        $item->price = $request->get("price");
        $item->category_id = $request->get("category_id");
        $item->brand_id = $request->get("brand_id");
        $item->name = $request->get("name");
        $item->year = $request->get("year");
        $item->description = $request->get("description");
//        $item->srok = $request->get("srok");
        $item->save();
        $id = $request->id;
//        return redirect('/details/change?id='.$id);
        return redirect('/details/change?id='.$id)->with('success', 'изменения сохранены!');
    }

//    public function updateItem(Request $request){
//        $request->validate([
//            'region_id'=>'required',
//            'city_id'=>'required',
//            'category_id'=>'required',
//            'brand_id'=>'required',
//            'name'=>'required',
//            'year'=>'required',
//            'description'=>'required',
//            'option'=>'required',
//            'price'=>'required'
//        ]);
//
////        return $request->all();
//        /* Сохраняем по старому */
//        $item = Item::find($request->get('id'));
//        $item->name = $request->get('name');
//        $item->year = $request->get('year');
//        $item->description = $request->get('description');
//        $item->price = $request->get('price');
////        $item->quantity = $request->get('quantity');
//        $item->option = $request->get('option');
//        $item->rental_option = $request->get('rental_option');
//        $item->category_id = $request->get('category_id');
//        $item->brand_id = $request->get('brand_id');
//        $item->save();
//
//        return redirect('/details/change?id='.$item->id);
//    }


    public function updateImg(Request $request, ValidateImgStore $req)
    {
        $item = Item::find($request->get('id'));
        /* 1 вариант как по курсу */
//        $file = $request->file('image');
//        $path = '/images/'.$file->getClientOriginalName();
//        $file->move('images/', $file->getClientOriginalName());

        /* 2 вариант */
        if ($req->hasFile('url')){
            $folder = date('Y-m-d');
            $path = $req->file('url')->store("images/{$folder}", "public");
        }

        ItemImage::where('item_id', $req->get('id'))->update(['url'=>$path]);
        return redirect('/details/change?id='.$item->id);
    }


    public function deleteExtention(Request $request){
        $item = Item::find($request->get('item_id'));

        return view('items.del_ext', compact('item'));
    }


    public function prolonation_102030days(Request $request){
        $item = Item::find($request->get('item_id'));
        $selectedSrok = $request->input("srok");

        // 1 вариант
        switch ($selectedSrok) {
            case 10:
                $new_srok = date("Y-m-d H:i:s", time()+60*60*24*10);
                break;
            case 20:
                $new_srok = date("Y-m-d H:i:s", time()+60*60*24*20);
                break;
            case 30:
                $new_srok = date("Y-m-d H:i:s", time()+60*60*24*30);
                break;
            default:
                echo "неправильный выбор";
        }

        // 2 вариант
//        $new_srok = date("Y-m-d H:i:s", time()+60*$selectedSrok);

//        $new_srok = date("Y-m-d H:i:s", time()+60*60*24*$selectedSrok);
        $item->srok = $new_srok;
        $item->save();

        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::where('user_id', $user->id)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $itemsArchives = Item::where('user_id', $user->id)
            ->where('srok', '<', date('Y-m-d H:i:s'))
            ->get();

        /* ниже все варианты работают */
//        return view('profile_page', compact('user', 'categories', 'brands', 'items', 'itemsArchives'))->with('success', 'Ваше объявление успешно продлен');
//        return redirect('/profile')->with('success', 'Ваше объявление продлен на '.$day.' дней!', ['user'=>'user', 'categories'=>'categories', 'brands'=>'brands', 'items'=>'items', 'itemsArchives'=>'itemsArchives']);
        return redirect()->route('profile')->with('success', 'Ваше объявление продлен на '.$selectedSrok.' дней!', ['user'=>'user', 'categories'=>'categories', 'brands'=>'brands', 'items'=>'items', 'itemsArchives'=>'itemsArchives']);
    }

}
