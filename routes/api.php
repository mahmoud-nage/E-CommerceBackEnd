<?php

use App\Http\Controllers\Api\BrandController;
use App\Models\Website\Area;
use App\Models\Website\Brand;
use App\Models\Website\Category;
use App\Models\Website\Country;
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
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = "products";
        $with = "products";
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Brand::class, $id, ['products'], null);
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

Route::group(['prefix' => 'categories'], function(){
    Route::get('/', function (Request $request){
        $model = Category::class;
        $conditions = [
            'type' => 0
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "subcategories"];
        $with = null;
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products', 'subcategories'], ["subcategories"]);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CategoryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'subCategories'], function(){
    Route::get('/', function (Request $request){
        $model = Category::class;
        isset($request->category_id)?$cat = $request->category_id:$cat = null;
        if($cat){
            $conditions = [
                'type' => 1,
                'parent_id' => $request->category_id
            ];
        }else{
            $conditions = [
                'type' => 1
            ];
        }

        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "subSubcategories"];
        $with = ["category"];
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products', 'subSubcategories'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CategoryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'subSubCategories'], function(){
    Route::get('/', function (Request $request){
        $model = Category::class;
        $conditions = [
            'type' => 2
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products"];
        $with = ["subCategory", 'getCategoryWithSubSub'];
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CategoryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'countries'], function(){
    Route::get('/', function (Request $request){
        $model = Country::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "cities"];
        $with = null;
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products', 'cities'], ["cities"]);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CountryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CountryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Country::class, $id, 'icon');
    });
});

Route::group(['prefix' => 'cities'], function(){
    Route::get('/', function (Request $request){
        $model = Category::class;
        isset($request->category_id)?$cat = $request->category_id:$cat = null;
        if($cat){
            $conditions = [
                'type' => 1,
                'parent_id' => $request->category_id
            ];
        }else{
            $conditions = [
                'type' => 1
            ];
        }

        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "subSubcategories"];
        $with = ["category"];
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['category', 'subSubcategories'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CategoryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, null);
    });
});

Route::group(['prefix' => 'areas'], function(){
    Route::get('/', function (Request $request){
        $model = Area::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = null;
        $with = ["city"];
        return ((new App\Http\Controllers\BaseController)->allData($model,$conditions,$sortBy,$sort,$with,$withCount,$to));
    });

    Route::get('/{id}', function ($id){
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['city'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id){
        return (new App\Http\Controllers\Api\CategoryController)->update($request,$id);
    });

    Route::post('/store', function (Request $request){
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id){
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, null);
    });
});





