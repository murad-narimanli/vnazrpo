<?php

use App\Models\AnnouncementObjectType;
use App\Models\AnnouncementType;
use App\Models\City;
use App\Models\Marker;
use App\Models\Metro;
use App\Models\Provience;
use App\Models\Settings;
use Illuminate\Support\Facades\Session;

function getServices()
{
    return \App\Models\Services::get();
}

function getAnnouncementObjectTypeName($type)
{
    return AnnouncementObjectType::where('_id', $type)->first();

}

function getAnnouncementTypeName($type)
{
    return AnnouncementType::where('_id', $type)->first();

}


function getProvienceName($type)
{
    return Provience::where('_id', $type)->first();

}

function getMetroName($type)
{
    return Metro::where('_id', $type)->first();
}

function getMarkerName($type)
{
    return Marker::where('_id', $type)->first();
}


function getCityName($type)
{
    return City::where('_id', $type)->first();
}


function getSocialAccount()
{
    return Settings::where('_id', "settings")->first();
}

if (!function_exists('getLangSess')) {
    function getLangSess()
    {
        return Session::get('language');
    }
}

if (!function_exists('langUrlPrefix')) {
    function langUrlPrefix()
    {
        return '/' . getLangSess();
    }
}

function FallBackLanguage($content)
{
    if (isset($content[app()->getLocale()]))
        return $content[app()->getLocale()];
    else {
        foreach (config('app.current_languages') as $language) {
            if ($language == app()->getLocale()) continue;
            if (isset($content[$language]))
                return $content[$language];
        }
    }
}


if (!function_exists('collectFilterConditions')) {
    function collectFilterConditions($request)
    {

        if (!is_array($request)) {
            return false;
        }
        $SFO = searchFilterOperators();
        $whereClauses = [];
        $counter = 0;
        $exceptions = ['province' => 'provience', 'metro' => 'metro', 'marker' => 'marker'];
        foreach ($request as $key => $value) {

            // RoomCount Exceptions
//            if ($key == 'roomCount')
//                continue;


            $whereClauses[$counter]['col'] = $key;
            $whereClauses[$counter]['operator'] = $SFO[$key] ?? '';
            $whereClauses[$counter]['value'] = $value;

            // Province, Metro, Marker Exception
            if (array_key_exists($key, $exceptions)) {
                $whereClauses[$counter]['col'] = @$exceptions[$key];
                $whereClauses[$counter]['value'] = explode(',', $value);
                $whereClauses[$counter]['operator'] = false;
            }

            $counter++;
        }
        return $whereClauses;
    }
}

if (!function_exists('searchFilterOperators')) {
    function searchFilterOperators()
    {
        return [
            "announcementType" => "=",
            "objectType" => "=",
            "roomCount" => "=",
            "floorMin" => ">=",
            "floorMax" => "<=",
            "priceMin" => ">=",
            "priceMax" => "<=",
            "areaMin" => ">=",
            "areaMax" => "<=",
            "landAreaMin" => ">=",
            "landAreaMax" => "<=",
            "repairStatus" => "=",
            "documentType" => "=",
        ];
    }
}

if (!function_exists('filterColsMapping')) {
    function filterColsMapping()
    {
        return [
            "announcementType" => "announcement-type",
            "objectType" => "announcement-object-type",
            "roomCount" => "total-room-count",
            "floorMin" => "current-floor",
            "floorMax" => "current-floor",
            "priceMin" => "price",
            "priceMax" => "price",
            "areaMin" => "area",
            "areaMax" => "area",
            "landAreaMin" => "land-area",
            "landAreaMax" => "land-area",
            "repairStatus" => "maintenancy-status",
            "documentType" => "document-type",
            "province" => "provience",
        ];
    }
}

if (!function_exists('applyFilterClausesOnQuery')) {
    function applyFilterClausesOnQuery($a, $filters)
    {
        $FCM = filterColsMapping();
        $arr_cast_int = ["total-room-count", "current-floor", "price", "area", "land-area"];
        foreach ($filters as $v) {
            $col = @$FCM[$v['col']];
            $v['value'] = in_array($col, $arr_cast_int) ? (int)$v['value'] : $v['value'];
            if ($v['operator'])
                $a->where('data.' . $col, $v['operator'], $v['value']);
            else {
                // debugDev($v['value']);
                $a->whereIn('data.' . $v['col'], $v['value']);
            }


        }
        return $a;
    }
}

if (!function_exists('debugDev')) {
    function debugDev($a, $var_dump = false)
    {
        if ($var_dump) {
            var_dump($a);
        } else {
            print_r($a);
        }
        die();

    }
}

if (!function_exists('alphabeticOrdering')) {
    function alphabeticOrdering(&$data)
    {
        $arr = [];
        foreach ($data as $key => $value) {
            $arr[$value['_id']] = ['data' => $value['data']];
        }
        uasort($arr, function ($elem1, $elem2) {
            return @strcmp($elem1['data']['title'][App::getLocale()], $elem2['data']['title'][App::getLocale()]);
        });
        return $data = $arr;
    }
}

function T($key)
{
    $lang = Config::get('app.locale');

    $translation = \App\Models\Translation::query()
        ->where('category', '=', 'frontend')
        ->where('key', '=', $key)
        ->get()
        ->all();
    if (count($translation) > 0) {
        if (isset($translation[0]['translations']) && isset($translation[0]['translations'][$lang])) {
            return $translation[0]['translations'][$lang];
        } else {
            return $key;
        }
    } else {
        $translation = new \App\Models\Translation();
        $translation->category = 'frontend';
        $translation->key = $key;
        $translation->save();

        return $key;
    }
}
