<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Residence;

class ResidenceController extends Controller
{
    public function index()
    {
        $residences = new Residence();

        if (isset($_GET['date']) && in_array($_GET['date'],['asc','desc',"ASC",'DESC'])) {
            $residences = $residences->orderBy('data.orderDate', $_GET['date'])->orderBy('publishDate',  $_GET['date']);
        }elseif (isset($_GET['area']) && in_array($_GET['area'],['asc','desc',"ASC",'DESC'])) {
            $residences = $residences->orderBy('data.area', $_GET['area']);
        }elseif (isset($_GET['price']) && in_array($_GET['price'],['asc','desc',"ASC",'DESC'])) {
            $residences = $residences->orderBy('data.price', $_GET['price']);
        }

        $residences=$residences->paginate(15);
        return view('residence', [
            'residences' => $residences,
        ]);
    }

    public function detail($id)
    {
        $residence = Residence::find($id) or die();
        $similar = Residence::limit(6)->get();
        return view('residence-detail', [
            'id' => $id,
            'residence' => $residence,
            'similar' => $similar,
        ]);
    }
}
