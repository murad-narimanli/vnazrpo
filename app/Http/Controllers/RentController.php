<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RentController extends Controller
{
    public function index($id = '')
    {
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');
        $objects = Announcement::where('data.status', 'ACTIVE')->where('data.announcement-type', '60bdf00f1f35a21fd8f3d4a9');
        if ($id) $objects = $objects->where('data.announcement-object-type', $id);



        if (isset($_GET['date']) && in_array($_GET['date'],['asc','desc',"ASC",'DESC'])) {
            $objects = $objects->orderBy('data.orderDate', $_GET['date'])->orderBy('publishDate',  $_GET['date']);
        }elseif (isset($_GET['area']) && in_array($_GET['area'],['asc','desc',"ASC",'DESC'])) {
            $objects = $objects->orderBy('data.area', $_GET['area']);
        }elseif (isset($_GET['price']) && in_array($_GET['price'],['asc','desc',"ASC",'DESC'])) {
            $objects = $objects->orderBy('data.price', $_GET['price']);
        }

        $objects=$objects->paginate(15);
        return view('rent', [
            'id' => $id,
            'objects' => $objects,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
        ]);
    }


    public function getObject(Request $request)
    {
        $objects = Announcement::where('data.status', 'ACTIVE');
        if ($request->type == "vip") {
            $objects = $objects->where('data.is-vip', true);
        } elseif ($request->type == "kiraye") {
            $objects = $objects->where('data.announcement-type', '60bdf00f1f35a21fd8f3d4a9');
        } else if($request->type == "son") {
            $objects = $objects->orderBy('data.orderDate', 'DESC');
        }
        $objects = $objects->orderBy('publishDate', 'desc')->get();
        return response()->json([
            $objects
        ]);
    }
}
