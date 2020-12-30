<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Company\Company;
use App\General\Country;
use App\Affilate\Affilate;
use App\Customer\Customer;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'confirmed|min:8',
            // 'avatar' => 'mimes:jpg,jpeg,png,tiff,gif',
            'default_lang' => 'required|in:ar,en',
            'phone' => 'required',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
//            'area_id' => 'required|exists:areas,id',
//            'zone_id' => 'required|exists:zones,id',
            // 'fcm_token' => 'required',
            'type' => 'required|in:Company,Marketer,Customer',
            // 'birth_date' => 'date',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'required|exists:categories,id',

        ];

        if ($request->has('type') && $request->type == 'Company') {
            $validate = array_merge($validate, [
                'name_ar' => 'nullable',
                'name_en' => 'required',
                'desc_ar' => 'nullable',
                'desc_en' => 'required',
                'address_ar' => 'nullable',
                'address_en' => 'required',
                // 'open_from' => 'required|date',
                // 'open_to' => 'required|date',
                'phone1' => 'required',
                'holiday' => 'required',
                // 'image' => 'required|mimes:jpg,jpeg,png,tiff,gif',
                // 'pdf' => 'mimes:pdf',
                'email' => 'string|email|max:191',
            ]);
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        if ($request->has('provider_id') && $request->provider_id) {
            $user = User::where('provider_id', $request->provider_id)->first();
            if (isset($user)) {
                return response()->json(['status' => 400, 'data' => $user, 'message' => __('messages.registered_before')], 200);
            }
        }
        $record = null;
        $user = null;
        if ($request->type == 'Customer') {
            $record = Customer::create();
        } elseif ($request->type == 'Marketer') {
            $record = Affilate::create(['ssd' => uniqid()]);
        } elseif ($request->type == 'Company') {
            $record = Company::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'desc_ar' => $request->desc_ar,
                'desc_en' => $request->desc_en,
                'address_ar' => $request->address_ar,
                'address_en' => $request->address_en,
                'open_from' => $request->open_from,
                'open_to' => $request->open_to,
                'phone1' => $request->phone1,
                'holiday' => $request->holiday,
                'email' => $request->email,
                // 'is_open' => $request->is_open,
                'is_open' => 1,
                'closed_reason' => $request->closed_reason,
                // 'branch_num' => $request->branch_num,
                'branch_num' => 0,
                'parent_id' => 0,
                'phone2' => $request->phone2,
                'tel' => $request->tel,
                'fax' => $request->fax,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'app' => 1,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'area_id' => $request->area_id,
                'zone_id' => $request->zone_id,
                'cat_id' => $request->cat_id,
                'sub_cat_id' => $request->sub_cat_id,
            ]);

            if ($request->hasFile('image')) {
                $path = 'uploads/companies/image';
                $name = webpUploadImage($request->image, $path);
                $record->image = $name;
                $record->save();
            }
            if ($request->hasFile('pdf')) {
                $path = 'uploads/companies/pdf';
                $name = webpUploadImage($request->avatar, $path);
                $record->pdf = $name;
                $record->save();
            }
        }

        if ($record) {
            $user = $record->user()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'default_lang' => $request->default_lang,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'area_id' => $request->area_id,
                'zone_id' => $request->zone_id,
                'type' => $request->type,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'national_id' => $request->national_id,
                'fcm_token' => $request->fcm_token,
                'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
                'provider' => $request->provider,
                'provider_id' => $request->provider_id,
            ]);
            if ($request->hasFile('avatar')) {
                $path = 'uploads/user/avatar';
                $name = webpUploadImage($request->avatar, $path);
                $user->avatar = $name;
                $user->save();
            }

            if ($user) {
                $token = $user->createToken('LaravelAuthApp')->accessToken;

                $user = User::find($user->id);
                return response()->json(['status' => 200, 'token' => $token, 'message' => __('messages.success_register')], 200);
            }
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function logins(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:provider_id,provider|exists:users',
            'password' => 'required_without:provider_id,provider',
//             'provider' => 'required_without: email',
            'provider_id' => 'required_with: provider',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = null;
        if ($request->has('email') && $request->has('password') && $request->email) {
//            $user = User::where('email', $request->email)->first();
            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
//                if (Hash::check($request->password, $user->password)) {

//                    $data = [
//                        'user' => $user,
//                        'info' => $user->userable,
//                    ];
//                    return response()->json(['status' => 200, 'message' => __('messages.welcome_msg'), 'data' => $data], 200);
//                }
            }
        } elseif ($request->has('provider') && $request->has('provider_id') && $request->provider_id) {
            $user = User::where('provider_id', $request->provider_id)->where('provider', $request->provider)->first();
            if ($user) {
                Auth::login($user);
                $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

//                $data = [
//                    'user' => $user,
//                    'info' => $user->userable,
//                ];
//                return response()->json(['status' => 200, 'message' => __('messages.welcome_msg'), 'data' => $data], 200);
            } elseif (!$user && $request->has('email') && $request->email) {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    $user->update([
                        'provider' => $request->provider,
                        'provider_id' => $request->provider_id
                    ]);
                    Auth::login($user);
                    $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
//                    $data = [
//                        'user' => $user,
//                        'info' => $user->userable,
//                    ];
//                    return response()->json(['status' => 200, 'message' => __('messages.welcome_msg'), 'data' => $data], 200);
                }
            } else {
                $record = Customer::create();
                $user = $record->user()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'default_lang' => $request->default_lang,
                    'phone' => $request->phone,
                    'country_id' => $request->country_id,
                    'city_id' => $request->city_id,
                    'area_id' => $request->area_id,
                    'zone_id' => $request->zone_id,
//                    'type' => 'Customer',
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'national_id' => $request->national_id,
                    'fcm_token' => $request->fcm_token,
                    'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
                    'provider' => $request->provider,
                    'provider_id' => $request->provider_id,
//                    'userable_id' => $record->id,
//                    'userable_type' => 'App\Customer\Customer',
                ]);
                if ($request->hasFile('avatar')) {
                    $path = 'uploads/user/avatar';
                    $name = webpUploadImage($request->avatar, $path);
                    $user->avatar = $name;
                    $user->save();
                }

                if ($user) {
                    Auth::login($user);
                    $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
//                    $user = User::find($user->id);
//                    return response()->json(['status' => 200, 'user' => $user, 'message' => __('messages.valid_login')], 200);
                }
            }
        }

        if (auth()->check() && $token) {
            if ($request->has('fcm_token') && $request->fcm_token) {
                auth()->user()->update([
                    'fcm_token' => $request->fcm_token
                ]);
            }
            return response()->json(['status' => 200, 'token' => $token, 'message' => __('messages.invalid_login')], 200);
        }
        return response()->json(['status' => 401, 'message' => __('messages.invalid_login')], 200);
    }

    public function sendMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $code = mt_rand(100000, 999999);
            $user->reset_code = $code;
            $user->save();
            Mail::to($request->email)->queue(new ResetPassword($code));
            return response()->json(['status' => 200, 'message' => __('messages.sent_code')]);
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function checkCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->reset_code == $request->input('code')) {
                return response()->json(['status' => 200, 'message' => __('messages.valid_code')], 200);
            }
            return response()->json(['status' => 400, 'message' => __('messages.invalid_code')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->reset_code == $request->code) {
                $user->password = Hash::make($request->password);
                $user->reset_code = NULL;
                $user->save();
                return response()->json(['status' => 200, 'message' => __('messages.update_pass')], 200);
            }
            return response()->json(['status' => 400, 'message' => __('messages.invalid_code')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = auth()->user()->with(['userable', 'reviews']);
        if ($user) {
            $data = [
                'user' => $user,
//                'info' => $user->userable->load('reviews')
            ];
            return response()->json(['status' => 200, 'data' => $data], 200);
        } else {
            return response()->json(['status' => 400, 'message' => __('messages.user_not_found')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function updateProfile(Request $request)
    {
        $validate = [
//            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id,
            'password' => 'confirmed|min:8',
            // 'avatar' => 'mimes:jpg,jpeg,png,tiff,gif',
            'default_lang' => 'required|in:ar,en',
            'phone' => 'required',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
//            'area_id' => 'required|exists:areas,id',
//            'zone_id' => 'required|exists:zones,id',
            // 'fcm_token' => 'required',
            'type' => 'required|in:Company,Marketer,Customer',
            // 'birth_date' => 'date',

        ];

        if ($request->has('type') && $request->type == 'Company') {
            $validate = array_merge($validate, [
                'name_ar' => 'nullable',
                'name_en' => 'required',
                'desc_ar' => 'nullable',
                'desc_en' => 'required',
//                'service_ar' => 'required',
//                'service_en' => 'required',
                'address_ar' => 'nullable',
                'address_en' => 'required',
                // 'open_from' => 'required|date',
                // 'open_to' => 'required|date',
                'phone1' => 'required',
                'holiday' => 'required',
                'email' => 'string|email|max:191',
            ]);
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = auth()->user();
        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'default_lang' => $request->default_lang,
                'phone' => $request->phone,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'area_id' => $request->area_id,
                'zone_id' => $request->zone_id,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'national_id' => $request->national_id,
            ]);

            if ($request->has('password') && $request->password) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            if ($user->type == 'Company') {
                $company = $user->userable;
                $user->userable()->update([
                    'name_ar' => $request->name_ar ? $request->name_ar : $company->name_ar,
                    'name_en' => $request->name_en ? $request->name_en : $company->name_en,
                    'desc_ar' => $request->desc_ar ? $request->desc_ar : $company->desc_ar,
                    'desc_en' => $request->desc_en ? $request->desc_en : $company->desc_en,
                    'service_ar' => $request->service_ar ? $request->service_ar : $company->service_ar,
                    'service_en' => $request->service_en ? $request->service_en : $company->service_en,
                    'address_ar' => $request->address_ar ? $request->address_ar : $company->address_ar,
                    'address_en' => $request->address_en ? $request->address_en : $company->address_en,
                    'open_from' => $request->open_from ? $request->open_from : $company->open_from,
                    'open_to' => $request->open_to ? $request->open_to : $company->open_to,
                    'phone1' => $request->phone1 ? $request->phone1 : $company->phone1,
                    'holiday' => $request->holiday ? $request->holiday : $company->holiday,
                    'email' => $request->email ? $request->email : $company->email,
                    'is_open' => $request->is_open ? $request->is_open : $company->is_open,
                    'closed_reason' => $request->closed_reason ? $request->closed_reason : $company->closed_reason,
                    'phone2' => $request->phone2 ? $request->phone2 : $company->phone2,
                    'tel' => $request->tel ? $request->tel : $company->tel,
                    'fax' => $request->fax ? $request->fax : $company->fax,
//                    'facebook' => $request->facebook ? $request->facebook : $company->facebook,
//                    'instagram' => $request->instagram ? $request->instagram : $company->instagram,
//                    'twitter' => $request->twitter ? $request->twitter : $company->twitter,
//                    'snapshat' => $request->snapshat ? $request->snapshat : $company->snapshat,
//                    'whatsapp' => $request->whatsapp ? $request->whatsapp : $company->whatsapp,
//                    'googleplus' => $request->googleplus ? $request->googleplus : $company->googleplus,
//                    'linked_in' => $request->linked_in ? $request->linked_in : $company->linked_in,
//                    'website' => $request->website ? $request->website : $company->website,
                    'lat' => $request->lat ? $request->lat : $company->lat,
                    'lon' => $request->lon ? $request->lon : $company->lon,
                    'country_id' => $request->country_id ? $request->country_id : $company->country_id,
                    'city_id' => $request->city_id ? $request->city_id : $company->city_id,
                    'area_id' => $request->area_id ? $request->area_id : $company->area_id,
                    'zone_id' => $request->zone_id ? $request->zone_id : $company->zone_id,
                ]);

                if ($request->hasFile('image')) {
                    $path = 'uploads/companies/image';
                    $name = webpUploadImage($request->image, $path);

                    $user->userable()->update([
                        'image' => $name
                    ]);
                }
                if ($request->hasFile('pdf')) {
                    $path = 'uploads/companies/pdf';
                    $name = webpUploadImage($request->avatar, $path);
                    $user->userable()->update([
                        'pdf' => $name
                    ]);
                }
            }

            $data = [
                'user' => $user,
                'info' => $user->userable()->load('reviews')
            ];
            return response()->json(['status' => 200, 'message' => __('messages.success_update_profile'), 'data' => $data], 200);
        }

        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function becomeAffilator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = User::find($request->user_id);
        if ($user->type == 'Customer') {
            $record = Affilate::create(['ssd' => uniqid()]);

            $user->userable()->delete();
            $user->update([
                'userable_id' => $record->id,
                'userable_type' => 'App\Affilate\Affilate',
                'type' => 'Marketer',
            ]);

            return response()->json(['status' => 200, 'message' => __('messages.become_affilator')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.not_customer')], 200);
    }

    public function becomeCompany(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name_ar' => 'nullable',
            'name_en' => 'required',
            'desc_ar' => 'nullable',
            'desc_en' => 'required',
//            'service_ar' => 'nullable',
//            'service_en' => 'required',
            'address_ar' => 'nullable',
            'address_en' => 'required',
            'open_from' => 'required|date',
            'open_to' => 'required|date',
            'phone1' => 'required',
            'holiday' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,tiff,gif',
            // 'pdf' => 'mimes:pdf',
            'email' => 'string|email|max:191',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'zone_id' => 'required|exists:zones,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $user = User::find($request->user_id);
        if ($user->type == 'Customer') {
            $record = Company::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'desc_ar' => $request->desc_ar,
                'desc_en' => $request->desc_en,
                'service_ar' => $request->service_ar,
                'service_en' => $request->service_en,
                'address_ar' => $request->address_ar,
                'address_en' => $request->address_en,
                'open_from' => $request->open_from,
                'open_to' => $request->open_to,
                'phone1' => $request->phone1,
                'holiday' => $request->holiday,
                'email' => $request->email,
                'closed_reason' => $request->closed_reason,
                'parent_id' => 0,
                'phone2' => $request->phone2,
                'tel' => $request->tel,
                'fax' => $request->fax,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'snapshat' => $request->snapshat,
                'whatsapp' => $request->whatsapp,
                'googleplus' => $request->googleplus,
                'linked_in' => $request->linked_in,
                'website' => $request->website,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'app' => 1,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'area_id' => $request->area_id,
                'zone_id' => $request->zone_id,
            ]);

            if ($request->hasFile('image')) {
                $path = 'uploads/companies/image';
                $name = webpUploadImage($request->image, $path);
                $record->image = $name;
                $record->save();
            }
            if ($request->hasFile('pdf')) {
                $path = 'uploads/companies/pdf';
                $name = webpUploadImage($request->avatar, $path);
                $record->pdf = $name;
                $record->save();
            }

            $user->userable()->delete();
            $user->update([
                'userable_id' => $record->id,
                'userable_type' => 'App\Company\Company',
                'type' => 'Company',
            ]);

            return response()->json(['status' => 200, 'message' => __('messages.become_company')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.not_customer')], 200);
    }
}
