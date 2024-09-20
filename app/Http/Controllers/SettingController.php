<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Setting;
use App\Models\Feedback;

class SettingController extends Controller
{
    public function toggleTheme(Request $request)
    {
        $setting = Setting::where('user_id', '=', $request->user_id)->get();
        $params = $request->all();
        if(!$setting->count()) {
            $setting = new Setting();
            $setting->user_id = $params['user_id'];
            $setting->theme = $params['theme'];
            if ($setting->save()) {
                $response['code'] = Response::HTTP_OK;
                $response['message'] = "Change theme success...!";
                return response()->json($response, Response::HTTP_CREATED);
            } else {
                $response['message'] = "Change theme fail...!";
                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $getTheme = $setting->first();
            $getTheme->theme = $params['theme'];
            if ($getTheme->save()) {
                $response['code'] = Response::HTTP_OK;
                $response['message'] = "Change Theme success...!";
                return response()->json($response, Response::HTTP_CREATED);
            } else {
                $response['message'] = "Change Theme fail...!";
                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
    
    public function toggleLang(Request $request)
    {
        $setting = Setting::where('user_id', '=', $request->user_id)->get();
        $params = $request->all();
        if(!$setting->count()) {
            $setting = new Setting();
            $setting->user_id = $params['user_id'];
            $setting->language = $params['language'];            
            if ($setting->save()) {
                $response['code'] = Response::HTTP_OK;
                $response['message'] = "Change Language success...!";
                return response()->json($response, Response::HTTP_CREATED);
            } else {
                $response['message'] = "Change Language fail...!";
                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $getLang = $setting->first();
            $getLang->language = $params['language'];
            if ($getLang->save()) {
                $response['code'] = Response::HTTP_OK;
                $response['message'] = "Change Language success...!";
                return response()->json($response, Response::HTTP_CREATED);
            } else {
                $response['message'] = "Change Language fail...!";
                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
    
    public function setLang($locale)
    {
        App::setLocale($locale);
        Session::put("locale", $locale);  
        return redirect()->back();
    }

}
