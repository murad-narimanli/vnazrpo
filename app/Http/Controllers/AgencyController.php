<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementObjectType;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgencyController extends Controller
{
    public function index()
    {
        $agency = Merchant::paginate(15);
        return view('agency', [
            'agency' => $agency
        ]);
    }

    public function detail($id, $type = '')
    {
        $agency = Merchant::where("_id",$id)->first() or die();
        $types = AnnouncementObjectType::all();
        $objects = Announcement::where('data.status', 'ACTIVE')->where('data.merchant', $id);
        if($type) $objects = $objects->where('data.announcement-object-type', $type);
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');
        $objects = $objects->paginate(15);
        return view('agency-detail', [
            'id' => $id,
            'type' => $type,
            'types' => $types,
            'agency' => $agency,
            'objects' => $objects,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList
        ]);
    }
}
