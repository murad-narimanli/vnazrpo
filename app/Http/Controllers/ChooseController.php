<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChooseController extends Controller
{
    public function index()
    {
        $lastest = Announcement::where('data.status', 'ACTIVE')
            ->whereIN('_id', json_decode(Session::get('selected') ?? '[0]'))
            ->orderBy('data.create-date', 'DESC')->limit(6)->get();
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');
        return view('choosed', [
            'lastest' => $lastest,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList
        ]);
    }

    public function add ($id)
    {
        $selected = (array)json_decode(Session::get('selected') ?? '[]');
        if(!in_array($id, $selected)) {
            $selected[] = $id;
            Session::put('selected', json_encode($selected));
            return response()->json(['status' => 'success']);
        }
        else return response()->json(['status' => 'error']);
    }

    public function remove ($id)
    {
        $selected = (array)json_decode(Session::get('selected') ?? '[]');
        if(in_array($id, $selected)) {
            unset($selected[array_search($id, $selected)]);
            // $selected[] = $id;
            Session::put('selected', json_encode($selected));
            return response()->json(['status' => 'success']);
        }
        else return response()->json(['status' => 'error']);
    }
}
