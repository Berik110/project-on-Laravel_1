<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    const PATH = 'admin.brands.';

    public function index(){
        $brands = Brand::all();
        return view(self::PATH .'index', compact('brands'));
    }

    /* Добавление Брэнда */
    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        Brand::create($request->all());
        return redirect('/admin/brand');
    }

    /* Удаление Брэнда */
    public function destroy($id){
        Brand::destroy($id);
        return redirect('/admin/brand');
    }

    /* Обновление Брэнда */
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'id'=>'required'
        ]);

        $brand = Brand::find($request->get('id'));
        $brand->name = $request->get('name');
        $brand->save();
        return redirect('/admin/brand');
    }

    /* Находим конректный Брэнд для Обновления*/
    public function show($id){
        $brand = Brand::find($id);
        return view('admin.brands.show', compact('brand'));
    }
}
