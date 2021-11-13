<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function index()
    {
        $pageContent = Page::where('data.url', "recording")->first();
        return view('recording', [
            'content' => $pageContent
        ]);
    }

    public function camera()
    {
        $pageContent = Page::where('data.url', "recording")->first();
        return view('recording', [
            'content' => $pageContent
        ]);
    }

    public function schema()
    {
        $pageContent = Page::where('data.url', "recording")->first();
        return view('recording', [
            'content' => $pageContent
        ]);
    }
}
