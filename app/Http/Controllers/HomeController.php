<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementObjectType;
use App\Models\AnnouncementType;
use App\Models\DocumentType;
use App\Models\MaintenancyStatus;
use App\Models\Marker;
use App\Models\Merchant;
use App\Models\Metro;
use App\Models\Provience;
use App\Models\Residence;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    public function homeOrder(Request $request)
    {
        $maintenancy = MaintenancyStatus::where('_id', $request->temirStatus)->first();
        $setting = Settings::first();

//        $content = Auth::user()->id . ' id-li istifadəçi mənzil sifarişi etdi:<br>';

        if ($request->input('selected') == 0) {
            $text = "Satıram";
        } else if ($request->input('selected') == 1) {
            $text = "Maraqlıdır";
        } else {
            $text = "Alıram";
        }

        $content = ' <b>Otaq sayı: </b> ' . $request->otaqSayi;
        if ($maintenancy != null)
            $content .= '<b>Vəziyyət: </b> ' . $maintenancy['data']['title']['az'];

        $content .= ' <b>Ölçü sahəsi: </b> ' . $request->kv;
        $content .= ' <b>' . $text . '</b>';
        $content .= ' <b>Ad soyad: </b> ' . $request->name;
        $content .= ' <b>Nömrə: </b> ' . $request->phone;
        $content .= ' <b>Email: </b> ' . $request->email;

        $email = new Mail();
        $email->setFrom("no-reply@ug.tisserv.net");
        $email->setSubject("Pulsuz qiymtətləndirmə");
        $email->addTo($setting['data']['order-house-email'], 'hrcell support');
//        $email->addTo("garavaliyevkamran@gmail.com", 'hrcell support');
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

        return redirect("/");
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


    public function index(Request $request)
    {

        if (!empty($request->input())) {
            return $this->indexSearch($request);
        }

        //Rayon,qesebe,nishangah,stansiya
        $provinces = Provience::all();
        alphabeticOrdering($provinces);
        $metroStations = Metro::all();
        $metroStationsPositionClassesOnView = $this->metroStationsPositionClassesOnView();
        $markers = Marker::all();
        alphabeticOrdering($markers);

        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');

        $announcementTypes = AnnouncementType::all();
        $announcementObjectTypes = AnnouncementObjectType::all();
        $maintainancyStatuses = MaintenancyStatus::all();
        $documentTypes = DocumentType::all();
        $agency = Merchant::where('data.type', '60bdf33e1f35a21fd8f3d4dc')->limit(6)->get();
        $vip = Announcement::where('data.status', 'ACTIVE')->where('data.is-vip', true)
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->limit(6)->get();
        $rent = Announcement::where('data.status', 'ACTIVE')->where('data.announcement-type', '60bdf00f1f35a21fd8f3d4a9')
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->limit(3)->get();
        $lastest = Announcement::where('data.status', 'ACTIVE')
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->limit(6)->get();
        $residence = Residence::limit(3)->get();
        $maintenancy = MaintenancyStatus::get();
        return view('home', [
            'request' => $request,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
            'agency' => $agency,
            'vip' => $vip,
            'rent' => $rent,
            'lastest' => $lastest,
            'residence' => $residence,
            'announcementTypes' => $announcementTypes,
            'announcementObjectTypes' => $announcementObjectTypes,
            'maintainancyStatuses' => $maintainancyStatuses,
            'documentTypes' => $documentTypes,
            'provinces' => $provinces,
            'metroStations' => $metroStations,
            'markers' => $markers,
            'metroStationsPositionClassesOnView' => $metroStationsPositionClassesOnView,
            'maintenancys' => $maintenancy
        ]);
    }

    public function indexSearch(Request $request)
    {
        $searchDataFilters = collectFilterConditions($request->input());

        //Rayon,qesebe,nishangah,stansiya
        $provinces = Provience::all();
        alphabeticOrdering($provinces);
        $metroStations = Metro::all();
        $metroStationsPositionClassesOnView = $this->metroStationsPositionClassesOnView();
        $markers = Marker::all();
        alphabeticOrdering($markers);

        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');

        $announcementTypes = AnnouncementType::all();
        $announcementObjectTypes = AnnouncementObjectType::all();
        $maintainancyStatuses = MaintenancyStatus::all();
        $documentTypes = DocumentType::all();
        $agency = Merchant::where('data.type', '60bdf33e1f35a21fd8f3d4dc')->limit(6)->get();

        // Vips
        DB::enableQueryLog(); // Enable query log

// Your Eloquent query executed by using get()

        $vip = Announcement::where('data.status', 'ACTIVE')->where('data.is-vip', true);
        $vip = applyFilterClausesOnQuery($vip, $searchDataFilters);
        $vip = $vip->limit(6)->get();
//        dd(DB::getQueryLog());
        // Vips End

        // Rents
        $rent = Announcement::where('data.status', 'ACTIVE')->where('data.announcement-type', '60bdf00f1f35a21fd8f3d4a9');
        $rent = applyFilterClausesOnQuery($rent, $searchDataFilters);
        $rent = $rent->limit(3)->get();
        // Rents End

        //Latests
        $lastest = Announcement::where('data.status', 'ACTIVE');
        $lastest = applyFilterClausesOnQuery($lastest, $searchDataFilters);
        $lastest = $lastest
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->limit(6)->get();

        //Latests End

        // Residences
        $residence = Residence::where('data.status', 'ACTIVE');
        $residence = applyFilterClausesOnQuery($residence, $searchDataFilters);
        $residence = $residence->limit(3)->get();
        // Residences End
        $maintenancy = MaintenancyStatus::get();
        return view('home', [
            'request' => $request,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
            'agency' => $agency,
            'vip' => $vip,
            'rent' => $rent,
            'lastest' => $lastest,
            'residence' => $residence,
            'announcementTypes' => $announcementTypes,
            'announcementObjectTypes' => $announcementObjectTypes,
            'maintainancyStatuses' => $maintainancyStatuses,
            'documentTypes' => $documentTypes,
            'provinces' => $provinces,
            'metroStations' => $metroStations,
            'markers' => $markers,
            'metroStationsPositionClassesOnView' => $metroStationsPositionClassesOnView,
            'maintenancys' => $maintenancy,
            'isFiltered' => true
        ]);
    }

    public function object($id)
    {

        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');

        $object = Announcement::find($id) or abort(404);
        Announcement::where('_id', $id)->update(['seen' => ($object['seen'] ?? 0) + 1]);

        $merchant = Merchant::find($object['data']['merchant'] ?? '');
        $similar = Announcement::where('data.status', 'ACTIVE')->where('data.announcement-object-type', $object['data']['announcement-object-type'] ?? '')
            ->orderBy('data.orderDate', 'DESC')
            ->orderBy('publishDate', 'DESC')
            ->limit(9)->get();
        return view('object', [
            'id' => $id,
            'object' => $object,
            'merchant' => $merchant,
            'similar' => $similar,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
        ]);
    }

    public function last()
    {
        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');

        $objects = Announcement::where('data.status', 'ACTIVE');

        if (isset($_GET['date']) && in_array($_GET['date'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.orderDate', $_GET['date'])->orderBy('publishDate', $_GET['date']);
        } elseif (isset($_GET['area']) && in_array($_GET['area'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.area', $_GET['area']);
        } elseif (isset($_GET['price']) && in_array($_GET['price'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.price', $_GET['price']);
        }

        $objects = $objects->paginate(15);
        $title = 'Son elanlar';
        return view('last', [
            'objects' => $objects,
            'headingTitle' => $title,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
        ]);
    }

    public function vip()
    {

        $inCompareList = (array)json_decode(Session::get('compare', 1) ?? '[]');
        $inFavoritesList = (array)json_decode(Session::get('selected', 1) ?? '[]');

        $objects = Announcement::where('data.status', 'ACTIVE')->where('data.is-vip', true);


        if (isset($_GET['date']) && in_array($_GET['date'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.orderDate', $_GET['date'])->orderBy('publishDate', $_GET['date']);
        } elseif (isset($_GET['area']) && in_array($_GET['area'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.area', $_GET['area']);
        } elseif (isset($_GET['price']) && in_array($_GET['price'], ['asc', 'desc', "ASC", 'DESC'])) {
            $objects = $objects->orderBy('data.price', $_GET['price']);
        }

        $objects = $objects->paginate(15);
        $title = 'VIP elanlar';
        return view('last', [
            'objects' => $objects,
            'headingTitle' => $title,
            'inCompareList' => $inCompareList,
            'inFavoritesList' => $inFavoritesList,
        ]);
    }

    private function metroStationsPositionClassesOnView()
    {
        return [
            "nesimi" => "top",
            "azadliq" => "top",
            "dernegul" => "right",
            "bakmil" => "left",
            "ecemi" => "right",
            "yanvar" => "right",
            "insaatcilar" => "right",
            "elimler" => "right",
            "nizami" => "bottom",
            "may" => "top",
            "xetail" => "right",
            "saxil" => "right",
            "iceri-seher" => "left",
            "genclik" => "left",
            "nerimanov" => "left",
            "ulduz" => "right",
            "koroglu" => "top",
            "qarayev" => "right",
            "neftciler" => "right",
            "xalqlar" => "right",
            "ahmedli" => "right",
            "hezi-aslanov" => "right",
        ];
    }
}
