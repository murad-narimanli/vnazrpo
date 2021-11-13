<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index($url = '')
    {

        App::setLocale(Session::get('language') ?? App::getLocale());
        $pageContent = Page::where('data.url.' . App::getLocale(), $url)->first();
        return view('page', [
            'pageContent' => $pageContent
        ]);
    }
}
