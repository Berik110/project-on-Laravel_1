<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddItemRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
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
        return view(self::PATH .'index', compact('items', 'brands', 'categories', 'user'));
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
        $item = Item::create($request->all());
        $file = $request->file('itemImage');
        $path = '/images/'.$file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);

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
        return view('admin.items.show', compact('item', 'brands', 'categories'));
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
        Item::where('id', $request->id)->update($request->except('id', '_method', '_token'));

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
        $items = Item::where('category_id', $request->get('category_id'))->paginate(6);
//        $items = Item::where('category_id', $request->get('category_id'))->simplePaginate(6);
//        $items = Item::where('category_id', $request->get('category_id'))->get();
        $categories = Category::all();
        $brands = Brand::all();
        $user = Auth::user();

        return view('items.by_category', compact('items', 'categories', 'brands', 'user'));
    }


    public function getDetails(Request $request){
        $item = Item::find($request->get('item_id'));

        return view('items.details', compact('item'));
    }

    public function option1(){
        $categories = Category::all();
        $brands = Brand::all();
//        $items = Item::where('option', 1)->get();
        $items = Item::where('option', 1)->paginate(6);

        return view('items.by_options1', compact('items', 'categories', 'brands'));
    }

    public function option2(){
        $categories = Category::all();
        $brands = Brand::all();
//        $items = Item::where('option', 2)->get();
        $items = Item::where('option', 2)->paginate(6);

        return view('items.by_options2', compact('items', 'categories', 'brands'));
    }

    public function forParts(){
//        $categories = Category::all();
//        $brands = Brand::all();
//        $items = Item::where('option', 2)->get();
        return view('items.parts');
    }

    public function search(Request $request){

        $category = $request->get('category_id');
        $brand = $request->get('brand_id');
//        $name = $request->get('name');
        $option = $request->get('option');
        $price_from = $request->get('priceFrom');
        $price_till = $request->get('priceTill');

       $items = Item::all();

        if ($category){
            $items =  $items->filter(function ($item) use ($category){
                return $item->category_id==$category;
            })->paginate(6);
        }

        if ($brand){
            $items =  $items->filter(function ($item) use ($brand){
                return $item->brand_id==$brand;
            })->paginate(6);
        }
//        if ($name){
//            $items =  $items->filter(function ($item) use ($name){
//                return $item->name==$name;
//            });
//        }
        if ($option){
            $items =  $items->filter(function ($item) use ($option){
                return $item->option==$option;
            })->paginate(6);
        }
        if ($price_from){
            $items =  $items->filter(function ($item) use ($price_from){
                return $item->price>=$price_from;
            })->paginate(6);
        }
        if ($price_till){
            $items =  $items->filter(function ($item) use ($price_till){
                return $item->price<=$price_till;
            })->paginate(6);
        }

        $brands = Brand::all();
        $categories = Category::all();
        $user = Auth::user();

        return view('items.by_category', compact('categories', 'brands', 'items', 'user'));
    }


    public function data(){
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::all();
        $users = User::all();

        return view('admin.index', compact('items', 'categories', 'brands', 'users'));
    }


    public function changeItem(Request $request){
        $categories = Category::all();
        $brands = Brand::all();
        $item = Item::find($request->get('id'));

        return view('items.change_item', compact('categories', 'brands', 'item'));
    }

    public function deleteItem(Request $request){
        Item::destroy($request->get("item_id"));
        return redirect('/');
    }

    public function updateItem(AddItemRequest $request)
    {
        /*Новая версия для сохранения если много полей*/
        Item::where('id', $request->id)->update($request->except('id', '_method', '_token'));
        $id = $request->id;
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

        return redirect('/details/change?id='.$id);
    }


    public function updateImg(Request $request)
    {
        $item = Item::find($request->get('id'));
        $file = $request->file('image');
        $path = '/images/'.$file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        ItemImage::where('item_id', $request->get('id'))->update(['url'=>$path]);
//        ItemImage::create(['url'=>$path, 'item_id'=>$item->id]);
        return redirect('/details/change?id='.$item->id);
    }


}
