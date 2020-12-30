<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\BaseController;
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
        (new App\Http\Controllers\Api\BrandController)->index($request);
    });
    Route::get('/{id}', function ($id){
        $data = (new App\Http\Controllers\BaseController)->getRecord(Brand::class, $id, null, ['products']);
        return JsonResponse(200,'',$data);
    });
    Route::get('destroy/{id}', function ($id){
        $data = (new App\Http\Controllers\BaseController)->destroyRecord(Brand::class, $id, null);
        return JsonResponse(200,'',$data);
    });
});


Route::resource('/brands', BrandController::class);





