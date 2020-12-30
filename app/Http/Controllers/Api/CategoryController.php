<?php

namespace App\Http\Controllers\API;

use App\General\Ad;
use App\General\BusinessSettings;
use App\General\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    private $setting;

    public function __construct()
    {
        $this->setting = BusinessSettings::all();
    }


    public function index(Request $request)
    {


        $lang = 'ar';
        if (!is_null($request->header('lang'))) {
            $lang = $request->header('lang');
        }

        $slider_count = $this->setting->where('type', 'special_ads_slider_count')->first();
        $slider_count = $slider_count ? $slider_count->value : 3;

        //  ********** Still not send banners and sliders ads ********** //
        $lang = 'ar';
        if ($request->headers->has('lang')) {
            $lang = $request->header('lang');
        }

        $categories = Category::where('parent_id', 0)->where('active', 1)->get();
        if ($categories->count() > 0) {
            $data = array();
            foreach ($categories as $category) {
                $subs = array();

                $ads = Ad::with(['company' => function ($q) use ($lang) {
                    $q->select('id', 'name_' . $lang . ' as name', 'total_rating', 'country_id', 'city_id', 'image', 'address_' . $lang . ' as address', 'desc_' . $lang . ' as desc');
                }])
                    ->where('ad_location', 'category')
                    ->where('to', '>=', today())
                    ->where('top', 0)
                    ->where('country_id', $request->country_id)->inRandomOrder()->take($slider_count)->get();

                if ($ads->count() > 0) {
                    $slider = [];
                    foreach ($ads as $key => $ad) {
                        $slider[] = [
                            'id' => $ad->id,
                            'company_id' => $ad->company_id,
                            'image' => $ad->image ? $ad->image : $ad->company->image,
                            'total_rating' => $ad->company->total_rating,
                            'name' => $ad->company->name,
                            'address' => $ad->company->country['name_' . $lang] . ',' . $ad->company->city['name_' . $lang] . ',' . $ad->company->address,
                            'distance' => '12 Kilo',
                            'city' => $ad->company->city['name_' . $lang]
                        ];
                    }
                }

                $subCategories = Category::where('parent_id', $category->id)->where('active', 1)->get();
                foreach ($subCategories as $subCategory) {
//                    $subsubCategories = Category::where('parent_id', $subCategory->id)->where('active', 1)->get();
//                    foreach ($subsubCategories as $sunsubCategory) {
//                        $subsub[] = [
//                            'id' => $sunsubCategory->id,
//                            'name' => $sunsubCategory['name_' . $lang],
//                            'products_num' => $sunsubCategory->companies->count(),
//                        ];
//                    }
                    $subs[] = [
                        'id' => $subCategory->id,
                        'name' => $subCategory['name_' . $lang],
                        'image' => $subCategory->image,
//                        'sub_sub_categories' => $subsub,
                    ];
//                    $subsub = [];
                }
                $data[] = [
                    'id' => $category->id,
                    'name' => $category['name_' . $lang],
                    'image' => $category->image,
                    'sub_categories' => $subs,
                    'ads' => $slider,

                ];
                $subs = [];
                $slider = [];
            }
            return response()->json(['status' => 200, 'data' => $data], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
        }
    }

    public function categories()
    {
        $records = Category::where('parent_id', 0)->where('active', 1)->get();
        if ($records) {
            return response()->json(['status' => 200, 'data' => $records], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
        }
    }

    public function subcategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $records = Category::where('parent_id', $request->category_id)->where('active', 1)->get();
        if ($records) {
            return response()->json(['status' => 200, 'data' => $records], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
        }
    }
}
