<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change ($language) {
        App::setLocale($language);
        config(['app.locale'=>$language]);
        Session::put('language', $language);
    }
}
