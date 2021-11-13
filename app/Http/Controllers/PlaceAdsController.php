<?php

namespace App\Http\Controllers;

use App\Models\AdverseType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceAdsController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $user = User::find(Auth::user()->id);

        $adverseTypes = AdverseType::all();

        return view('place-ads', [
            'adverseTypes' => $adverseTypes,
            'user' => $user
        ]);
    }
}
