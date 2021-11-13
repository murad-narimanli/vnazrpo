<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function index($url) {
        $page = Page::where('data.url.az', '=', $url)->get()->first();

        return view('static', [
            'page' => $page
        ]);
    }
}
