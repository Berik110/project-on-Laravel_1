<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group([
    "prefix"=>"/admin",
    "as"=>'admin.',
    "middleware"=>"admin"
], function(){
//    Route::get('/', function () {return view('admin.index');})->name('index');
    Route::get('/', [ItemController::class, 'data'])->name('index');

    //brand
    Route::prefix('brand')->group(function (){
        Route::get('/', [BrandController::class, 'index'])->name('brands');
        Route::post('/', [BrandController::class, 'store'])->name('brandInsert');
        Route::delete('/{id}', [BrandController::class, 'destroy']);
        Route::get('/{id}', [BrandController::class, 'show'])->name('brandShow');
        Route::put('/', [BrandController::class, 'update'])->name('brandUpdate');
    });
//    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
//    Route::post('/brand', [BrandController::class, 'store'])->name('brandInsert');
//    Route::post('/brand/{id}', [BrandController::class, 'store']);

    //category
    Route::prefix('category')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/', [CategoryController::class, 'store'])->name('categoryInsert');
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
        Route::get('/{id}', [CategoryController::class, 'show'])->name('categoryShow');
        Route::put('/', [CategoryController::class, 'update'])->name('categoryUpdate');
    });

    Route::prefix('item')->group(function (){
        Route::get('/', [ItemController::class, 'index'])->name('items');
        Route::post('/', [ItemController::class, 'store'])->name('itemInsert');
        Route::delete('/{id}', [ItemController::class, 'destroy']);
        Route::get('/{id}', [ItemController::class, 'show'])->name('itemShow');
        Route::put('/', [ItemController::class, 'update'])->name('itemUpdate');
    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/advertpage', [App\Http\Controllers\HomeController::class, 'addAdvPage'])->name('adv');
Route::post('/', [App\Http\Controllers\HomeController::class, 'storeAdd'])->name('toAddAdv');
Route::get('/categories', [App\Http\Controllers\ItemController::class, 'itemsByCategory'])->name('categories');
Route::get('/details', [App\Http\Controllers\ItemController::class, 'getDetails'])->name('details');
Route::get('/rental', [App\Http\Controllers\ItemController::class, 'option1']);
Route::get('/sell', [App\Http\Controllers\ItemController::class, 'option2']);
Route::get('/parts', [App\Http\Controllers\ItemController::class, 'forParts']);
Route::get('/search_items', [App\Http\Controllers\ItemController::class, 'search'])->name('search');
Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profilePage'])->name('profile');
Route::get('/details/change', [\App\Http\Controllers\ItemController::class, 'changeItem'])->name('change');
Route::delete('/details/change', [\App\Http\Controllers\ItemController::class, 'deleteItem'])->name('todeleteItem');
Route::put('/details/change', [\App\Http\Controllers\ItemController::class, 'updateItem'])->name('updateItem');
Route::put('/details/change/img', [\App\Http\Controllers\ItemController::class, 'updateImg']);

Route::get('/regions/{id}', [\App\Http\Controllers\RegionController::class, 'getCity'])->name('getCity');
Route::get('/reg/{id}', [\App\Http\Controllers\RegionController::class, 'cities'])->name('cities');
