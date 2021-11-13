<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function index()
    {
        $compare = Announcement::where('data.status', 'ACTIVE')
            ->whereIN('_id', json_decode(Session::get('compare') ?? '[0]'))
            ->orderBy('data.create-date', 'DESC')->get();
        if(count($compare) === 0) return redirect('/');
        return view('compare', [
            'compare' => $compare
        ]);
    }

    public function add ($id)
    {
        $compare = (array)json_decode(Session::get('compare') ?? '[]');
        if(count($compare) != 3 && !in_array($id, $compare)) {
            $compare[] = $id;
            Session::put('compare', json_encode($compare));
            return response()->json(['status' => 'success']);
        }
        else return response()->json(['status' => 'error']);
    }

    public function remove($id)
    {
        $compare = (array)json_decode(Session::get('compare') ?? '[]');
        $new = [];
        foreach ($compare as $value)
        {
            if($value != $id) $new[] = $value;
        }
        Session::put('compare', json_encode($new));
        return response()->json(['status' => 'success']);
    }
}
