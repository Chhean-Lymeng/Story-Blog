<?php
use Carbon\Carbon;

if (!function_exists('app_lang')) {
    function app_lang($en, $kh)
    {
        $lang = request()->header('accept-language');
        return $lang == 'en' ? $en ?? '' : $kh ?? '';
    }
}

if (!function_exists('app_date')) {
    function app_date($date)
    {
        $date = Carbon::parse($date, 'Asia/Phnom_Penh')->format('d-m-Y h:i A');
        return $date;
    }
}

if (!function_exists('release_date')) {
    function release_date($date)
    {
        $date = Carbon::parse($date, 'Asia/Phnom_Penh')->format('d-m-Y');
        return $date;
    }
}


if (!function_exists('date_insert')) {
    function date_insert($date)
    {
        $dateTime = Carbon::parse($date, 'Asia/Phnom_Penh')->format('Y-m-d H:i:s');
        return $dateTime;
    }
}


// multi_lang
if (!function_exists('multi_lang')) {
    function multi_lang($de, $en)
    {
        $lang = request()->header('accept-language');
        return $lang != 'en' ? $de ?? '' : $en ?? '';
    }
}