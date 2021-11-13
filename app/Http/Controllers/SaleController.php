<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    public function index($id = '')
    {
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');
        $objects = Announcement::where('data.status', 'ACTIVE')->where('data.announcement-type', '60c114251f35a21fd8f3d55e');
        if($id) $objects = $objects->where('data.announcement-object-type', $id);
        $objects = $objects
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->paginate(15);
        return view('sale', [
            'id' => $id,
            'objects' => $objects,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList
        ]);
    }
}
