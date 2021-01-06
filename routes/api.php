<?php

use App\Models\Users\Customer;
use App\Models\Users\Seller;
use App\Models\Website\Area;
use App\Models\Website\Brand;
use App\Models\Website\Category;
use App\Models\Website\City;
use App\Models\Website\Country;
use App\Models\Website\Review;
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


Route::group(['prefix' => 'brands'], function () {
    Route::get('/', function (Request $request) {
        $model = Brand::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = "products";
        $with = "products";
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Brand::class, $id, ['products'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\BrandController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\BrandController)->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Brand::class, $id, 'logo');
    });
});

Route::group(['prefix' => 'reviews'], function () {
    Route::get('/', function (Request $request) {
        $model = Review::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ['product'=> function($q){
            $q->with('user');
        }, 'user'];
        $with = null;
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Review::class, $id, ['product'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\BrandController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\BrandController)->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Review::class, $id, 'logo');
    });
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', function (Request $request) {
        $model = Category::class;
        $conditions = [
            'type' => 0
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "subcategories"];
        $with = null;
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products', 'subcategories'], ["subcategories"]);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CategoryController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'subCategories'], function () {
    Route::get('/', function (Request $request) {
        $model = Category::class;
        isset($request->category_id) ? $cat = $request->category_id : $cat = null;
        if ($cat) {
            $conditions = [
                'type' => 1,
                'parent_id' => $request->category_id
            ];
        } else {
            $conditions = [
                'type' => 1
            ];
        }

        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "subSubcategories"];
        $with = ["category"];
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products', 'subSubcategories'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CategoryController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'subSubCategories'], function () {
    Route::get('/', function (Request $request) {
        $model = Category::class;
        $conditions = [
            'type' => 2
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products"];
        $with = ["subCategory", 'getCategoryWithSubSub'];
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Category::class, $id, ['products'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CategoryController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CategoryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Category::class, $id, 'image');
    });
});

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', function (Request $request) {
        $model = Country::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["products", "cities"];
        $with = null;
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Country::class, $id, ['products', 'cities'], ["cities", 'products']);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CountryController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CountryController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Country::class, $id, 'icon');
    });
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', function (Request $request) {
        $model = City::class;
        isset($request->country_id) ? $country_id = $request->country_id : $country_id = null;
        if ($country_id) {
            $conditions = [
                'country_id' => $request->country_id
            ];
        } else {
            $conditions = [
            ];
        }
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = ["areas"];
        $with = ["country"];
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(City::class, $id, ['country'], ['areas']);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CityController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CityController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(City::class, $id, null);
    });
});

Route::group(['prefix' => 'areas'], function () {
    Route::get('/', function (Request $request) {
        $model = Area::class;
        $conditions = [
        ];
        $sortBy = null;
        $sort = null;
        $to = $request->to;
        $withCount = null;
        $with = ["city", "country"];
        return ((new App\Http\Controllers\BaseController)->allData($model, $conditions, $sortBy, $sort, $with, $withCount, $to));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Area::class, $id, ['city'], null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\AreaController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\AreaController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Area::class, $id, null);
    });
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('/', function (Request $request) {
        return ((new App\Http\Controllers\Api\CustomerController)->index($request));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Customer::class, $id,
            ['user' => function($q){
                $q->with('country','city');
            }, 'orders', 'reviews' => function($q){
                $q->with('product');
            }, 'wishlists' => function($q){
                $q->with('product');
            }, 'tickets', 'address' => function($q){
                $q->with('country','city','area');
            }]
            , null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\CustomerController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\CustomerController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Customer::class, $id, null);
    });
});

Route::group(['prefix' => 'sellers'], function () {
    Route::get('/', function (Request $request) {
        return ((new App\Http\Controllers\Api\SellerController)->index($request));
    });

    Route::get('/{id}', function ($id) {
        return (new App\Http\Controllers\BaseController)->getRecord(Seller::class, $id,
            ['user' => function($q){
                $q->with('country','city');
            }, 'orderDetails', 'tickets', 'payments']
            , null);
    });

    Route::put('/{id}/update', function (Request $request, $id) {
        return (new App\Http\Controllers\Api\SellerController)->update($request, $id);
    });

    Route::post('/store', function (Request $request) {
        return (new App\Http\Controllers\Api\SellerController())->store($request);
    });

    Route::delete('/{id}/destroy', function ($id) {
        return (new App\Http\Controllers\BaseController)->destroyRecord(Customer::class, $id, null);
    });
});





