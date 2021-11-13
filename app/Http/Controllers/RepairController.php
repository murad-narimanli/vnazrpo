<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class RepairController extends Controller
{
    public function index() {
    	$data = [
    		'portfolio'=>Portfolio::get()->first()['data']
    	];
        return view('repair',$data);
    }
}
