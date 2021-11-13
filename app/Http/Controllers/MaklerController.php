<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementObjectType;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MaklerController extends Controller
{
    public function index()
    {
        $makler = Merchant::where('data.type', '60bdf3371f35a21fd8f3d4d8')->get();
        return view('makler', [
            'makler' => $makler
        ]);
    }

    public function detail($id, $type = '')
    {
        $makler = Merchant::find($id)->first() or die();
        $types = AnnouncementObjectType::all();
        $objects = Announcement::where('data.status', 'ACTIVE')->where('data.merchant', $id);
        if($type) $objects = $objects->where('data.announcement-object-type', $type);
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');
        $objects = $objects->get();
        return view('makler-detail', [
            'id' => $id,
            'type' => $type,
            'types' => $types,
            'makler' => $makler,
            'objects' => $objects,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList
        ]);
    }
}
