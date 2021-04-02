<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const PATH = 'admin.categories.';

    public function index()
    {
        $categories = Category::all();
        return view(self::PATH . 'index', compact('categories'));
    }

    /* Добавление Категории */
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'cat_url'=>'required'
        ]);
        $name = $request->get('name');

//        $category = Category::create($request->all());
        $file = $request->file('cat_url');
        $path = '/images/'.$file->getClientOriginalName();
        $file->move('images/', $file->getClientOriginalName());

        Category::create(['name'=>$name, 'cat_url'=>$path]);
        return redirect('/admin/category');
    }

    /* Удаление Категории */
    public function destroy($id){
        Category::destroy($id);
        return redirect('/admin/category');
    }

    /* Находим конректную Категорию для Обновления*/
    public function show($id){
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    /* Обновление Категории */
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'id'=>'required'
        ]);

        $category = Category::find($request->get('id'));
        $category->name = $request->get('name');
        $category->save();
        return redirect('/admin/category');
    }


}
