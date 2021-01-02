<?php

use App\Http\Controllers\Api\BrandController;
use App\Models\Website\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:admin')->get('/user', function (Request $request) {
    return 'welcome admin';
});


Route::group(['prefix' => 'brands'], function(){
    Route::get('/', function (Request $request){
        $model = Brand::class;
        $conditions = [
            'active' => 1,
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = "products";
        $with = "products";
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Brand::class, $id, null, ['products']);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\BrandController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\BrandController)->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Brand::class, $id, 'logo');
    });
});





