<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RentController;
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

    //items
    Route::prefix('item')->group(function (){
        Route::get('/', [ItemController::class, 'index'])->name('items');
        Route::post('/', [ItemController::class, 'store'])->name('itemInsert');
        Route::delete('/{id}', [ItemController::class, 'destroy']);
        Route::get('/{id}', [ItemController::class, 'show'])->name('itemShow');
        Route::put('/', [ItemController::class, 'update'])->name('itemUpdate');
    });

    //regions
    Route::prefix('region')->group(function (){
        Route::get('/', [RegionController::class, 'index'])->name('regions');
        Route::post('/', [RegionController::class, 'store'])->name('regionInsert');
        Route::delete('/{id}', [RegionController::class, 'destroy']);
        Route::get('/{id}', [RegionController::class, 'show'])->name('regionShow');
        Route::put('/', [RegionController::class, 'update'])->name('regionUpdate');
    });

    //cities
    Route::prefix('city')->group(function (){
        Route::get('/', [CityController::class, 'index'])->name('cities');
        Route::post('/', [CityController::class, 'store'])->name('cityInsert');
        Route::delete('/{id}', [CityController::class, 'destroy']);
        Route::get('/{id}', [CityController::class, 'show'])->name('cityShow');
        Route::put('/', [CityController::class, 'update'])->name('cityUpdate');
    });

    //options
    Route::prefix('option')->group(function (){
        Route::get('/', [OptionController::class, 'index'])->name('options');
        Route::post('/', [OptionController::class, 'store'])->name('optionInsert');
        Route::delete('/{id}', [OptionController::class, 'destroy']);
        Route::get('/{id}', [OptionController::class, 'show'])->name('optionShow');
        Route::put('/', [OptionController::class, 'update'])->name('optionUpdate');
    });

    //options_type
    Route::prefix('option_type')->group(function (){
        Route::get('/', [RentController::class, 'index'])->name('options_types');
        Route::post('/', [RentController::class, 'store'])->name('optionTypesInsert');
        Route::delete('/{id}', [RentController::class, 'destroy']);
        Route::get('/{id}', [RentController::class, 'show'])->name('optionTypesShow');
        Route::put('/', [RentController::class, 'update'])->name('optionTypeUpdate');
    });
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/advertpage', [App\Http\Controllers\HomeController::class, 'addAdvPage'])->name('adv');
Route::post('/', [App\Http\Controllers\HomeController::class, 'storeAdd'])->name('toAddAdv');
Route::get('/categories', [App\Http\Controllers\ItemController::class, 'itemsByCategory'])->name('categories');
Route::get('/details', [App\Http\Controllers\ItemController::class, 'getDetails'])->name('details');
Route::get('/rental', [App\Http\Controllers\ItemController::class, 'option1'])->name('rental');
Route::get('/sell', [App\Http\Controllers\ItemController::class, 'option2'])->name('sell');
Route::get('/service', [App\Http\Controllers\ItemController::class, 'option3'])->name('service');
Route::get('/parts', [App\Http\Controllers\ItemController::class, 'option4'])->name('parts');
Route::get('/search_items', [App\Http\Controllers\ItemController::class, 'search'])->name('search');
Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profilePage'])->name('profile')->middleware('auth');
Route::get('/profile/archives', [\App\Http\Controllers\UserController::class, 'profilePage2'])->name('profile2')->middleware('auth');
Route::get('/details/change', [\App\Http\Controllers\ItemController::class, 'changeItem'])->name('change');
Route::delete('/details/change', [\App\Http\Controllers\ItemController::class, 'deleteItem'])->name('todeleteItem')->middleware('auth');
Route::delete('/details/changes', [\App\Http\Controllers\ItemController::class, 'deleteItem2'])->name('todeleteItem2')->middleware('auth');
Route::put('/details/change', [\App\Http\Controllers\ItemController::class, 'updateItem'])->name('updateItem');
Route::put('/details/change/img', [\App\Http\Controllers\ItemController::class, 'updateImg']);
Route::get('/setting', [\App\Http\Controllers\UserController::class, 'settingPage'])->name('setting')->middleware('auth');
Route::put('/setting/saves', [\App\Http\Controllers\UserController::class, 'settingSavePage'])->name('save_setting');
Route::get('/profile/archives/proceed', [App\Http\Controllers\ItemController::class, 'deleteExtention'])->name('delExt');
Route::put('/profile/archives/pro', [App\Http\Controllers\ItemController::class, 'prolonation_102030days'])->name('prolong_10days');
Route::put('/profile/archives/prolong', [App\Http\Controllers\ItemController::class, 'prolonation_102030days'])->name('prolong_20days');
Route::put('/profile/archives/prolongat', [App\Http\Controllers\ItemController::class, 'prolonation_102030days'])->name('prolong_30days');


Route::get('/regions/{id}', [\App\Http\Controllers\RegionController::class, 'getCity'])->name('getCity');
Route::get('/reg/{id}', [\App\Http\Controllers\RegionController::class, 'cities'])->name('cities');
Route::get('/opt/{option_id}', [\App\Http\Controllers\RentController::class, 'rentalOptions'])->name('rentalOptions');
