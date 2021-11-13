<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index($url = null)
    {
        if ($url == null) return abort(404);
        $pageContent = Services::where('data.url.' . app()->getLocale(), $url)->first();
        return view('recording', [
            'content' => $pageContent
        ]);
    }
}
