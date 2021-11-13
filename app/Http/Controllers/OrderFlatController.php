<?php

namespace App\Http\Controllers;

use App\Models\MaintenancyStatus;
use App\Models\Marker;
use App\Models\Metro;
use App\Models\Provience;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;
use SendGrid\Mail\Mail;

class OrderFlatController extends Controller
{
    public function index(Request $request)
    {

        $provinces = Provience::all();
        alphabeticOrdering($provinces);
        $metroStations = Metro::all();
        $metroStationsPositionClassesOnView = $this->metroStationsPositionClassesOnView();
        $markers = Marker::all();
        alphabeticOrdering($markers);

        $isPosted = false;
        $maintenancy = MaintenancyStatus::get();
        if ($request->method() == 'POST') {
            $this->addOrderFlat($request);
            $isPosted = true;
        }

        return view('order-flat', [
            'isPosted' => $isPosted, 'maintenancys' => $maintenancy,
            'request' => $request,
            'provinces' => $provinces,
            'metroStations' => $metroStations,
            'markers' => $markers,
            'metroStationsPositionClassesOnView' => $metroStationsPositionClassesOnView,
        ]);
    }

    private function addOrderFlat($request)
    {

        if (!($request->method() == 'POST'))
            die();

        $maintenancy = MaintenancyStatus::where('_id', $request->temirStatus)->first();
        $setting = Settings::first();

        $content = Auth::user()->id . ' id-li istifadəçi mənzil sifarişi etdi:<br>';
        $content .= ' <b>Satış: </b> ' . $request->input('satis');
        $content .= ' <b>Əmlak tipi: </b> ' . $request->input('emlakTipi');
        $content .= ' <b>Qiymət: </b> ' . $request->input('minPrice') . ' - ' . $request->input('maxPrice');
        $content .= ' <b>Sahə: </b> ' . $request->input('areaMin') . ' - ' . $request->input('areaMax');
        if ($maintenancy != null)
            $content .= '<b>Təmir statusu: </b> ' . $maintenancy['data']['title']['az'];
        $this->sendemail($setting['data']['order-house-email'], 'no-reply@ug.tisserv.net', 'Mənzil sifarişi', $content);
    }

    public function sendemail($to, $from, $subject, $content)
    {

        $email = new Mail();
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->addTo($to, 'hrcell support');
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", $content
        );

        $sendgrid = new \SendGrid('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');
        try {
            $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }


    private function metroStationsPositionClassesOnView(){
        return [
            "nesimi"=>"top",
            "azadliq"=>"top",
            "dernegul"=>"right",
            "bakmil"=>"left",
            "ecemi"=>"right",
            "yanvar"=>"right",
            "insaatcilar"=>"right",
            "elimler"=>"right",
            "nizami"=>"bottom",
            "may"=>"top",
            "xetail"=>"right",
            "saxil"=>"right",
            "iceri-seher"=>"left",
            "genclik"=>"left",
            "nerimanov"=>"left",
            "ulduz"=>"right",
            "koroglu"=>"top",
            "qarayev"=>"right",
            "neftciler"=>"right",
            "xalqlar"=>"right",
            "ahmedli"=>"right",
            "hezi-aslanov"=>"right",
        ];
    }
}
