<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class BusinessCenterController extends Controller
{
    public function index()
    {
        $businesCenter = Merchant::get();
        return view('business', [
            'businesCenter' => $businesCenter
        ]);
    }

    public function detail($id)
    {
        return view('agency-detail', [
            'id' => $id
        ]);
    }
}
