@extends('index')

@section('title')
    {{FallBackLanguage(@getAnnouncementTypeName(@$object['data']['announcement-type'])['data']['title'])}}

    {{@$object['data']['total-room-count']}} {{T("otaqlı")}}
    {{FallBackLanguage(@getAnnouncementObjectTypeName(@$object['data']['announcement-object-type'])['data']['title'])}}
    {{@$object['data']['area']}} &#13217;
                                                            ,
                                                            @if(isset($object['data']['metro']))
                {{FallBackLanguage(getMetroName(@$object['data']['metro'])['data']['title'])}}
            @elseif(isset($object['data']['marker']))
                {{@FallBackLanguage(getMarkerName(@$object['data']['marker'])['data']['title'])}}
            @else
                {{FallBackLanguage(@getProvienceName(@$object['data']['provience'])['data']['title'])}}
            @endif
            - Evin.az

            @endsection

            @section('header')
                <link rel="stylesheet" href="{{asset('assets/object/style.css?cssv=4')}}">
                <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
                <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
                <link rel="stylesheet" href="{{asset('assets/home/custom.css?cssv=4')}}">
            @endsection

            @php
                use \Illuminate\Support\Facades\App;
                use \Illuminate\Support\Facades\Session;
                App::setLocale(Session::get('language') ?? App::getLocale())
            @endphp

            @section('content')
                <main>
        <article class="home-card-article">
            <section>
                <div class="inner-home-container container" style="padding: 0 !important;">
                    <div class="home-card-inner-header">
                        <div class="home-card-inner-header-left">
                            <p><a href="/">{{T("Ana səhifə")}}</a> <span>></span> </p>
                            <p><a href="/{{app()->getLocale()}}/rent">{{FallBackLanguage(@getAnnouncementTypeName(@$object['data']['announcement-type'])['data']['title'])}}</a><span>></span> </p>
                            <p><a href="/{{app()->getLocale()}}/rent/{{@$object['data']['announcement-object-type']}}">{{FallBackLanguage(@getAnnouncementObjectTypeName(@$object['data']['announcement-object-type'])['data']['title'])}}</a></p>
                        </div>

                        <div class="home-card-inner-header-right">
                            <p>{{T("Elan ID")}}: {{$object['postId']}}</p>
                        </div>
                    </div>

                    <div class="home-card-inner-header-mobile" id="goBack">
                        <div class="home-card-inner-header-left-mobile">
                            <p><i class="fas fa-chevron-left"></i><a href="#">{{T("Axtarışa geri dön")}}</a></p>
                        </div>
                    </div>

                    <div class="home-card-main-section">
                        <div class="home-card-main-section-flex">
                            <div class="home-card-left-section">

                                <div class="home-card-left-section-left">

                                    <div>

                                        <div class="home-card-left-section-left-images">
                                            <div class="home-card-inner-main-img-section object-page-slide"
                                                 style="width: 100%;">
                                                @foreach($object['data']['images'] ?? [] as $valueImg)
                                                    <div class="home-card-inner-main-img">
                                                        <figure class="mobile-padding">
                                                            <img
                                                                src="http://evinaznew.cms.kube.tisserv.net/upload/crop/700/641/{{$valueImg['path'] ?? ''}}"
                                                                alt="">
                                                        </figure>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="slider-nav" style="width: 100%; max-width: 700px">
                                                @foreach($object['data']['images'] ?? [] as $valueImg)
                                                    <div class="nav-slider-card">
                                                        <figure>
                                                            <div>
                                                              <img
                                                                  class="mobile-img"
                                                                  src="http://evinaznew.cms.kube.tisserv.net/upload/crop/107/71/{{$valueImg['path'] ?? ''}}"
                                                                  alt="">
                                                            <div>
                                                        </figure>
                                                    </div>
                                                @endforeach
                                            </div>


                                        </div>

                                        <div class="custom__left-section object-mob-element">
                                            <div class="home-card-right-section">
                                                <div class="home-card-right-section-first">
                                                    <div
                                                        class="home-card-right-section-first-sell">{{\App\Models\AnnouncementType::find($object['data']['announcement-type'])['data']['title'][App::getLocale()] ?? ''}}</div>
                                                    <div
                                                        class="home-card-right-section-first-price price-dots">{{@$object['data']['price']}} {{@\App\Models\CurrencyType::find($object['data']['currency'])['data']['title'][App::getLocale()] ?? ''}}</div>
                                                </div>

                                                <div class="home-card-right-section-second">
                                                    <div class="home-card-right-section-second-first-row">
                                                        <i class="fas fa-user"></i>
                                                        <div>
                                                            @isset($merchant['data']['fullname'])
                                                                <p>{{$merchant['data']['fullname'] ?? ''}}</p>
                                                            @endisset
                                                            @isset($object['data']['userFullName'])
                                                                <p>{{$object['data']['userFullName'] ?? ''}}</p>
                                                            @endisset
                                                            <p class="indirect">
                                                                ({{\App\Models\MerchantType::find($merchant['data']['type'] ?? '')['data']['title'][App::getLocale()] ?? ''}}
                                                                )</p>
                                                        </div>
                                                    </div>
                                                    <div class="home-card-right-section-second-second-row">
                                                        <i class="fas fa-phone-volume"></i>
                                                        <div>
                                                            @isset($merchant['data']['phone-number'])
                                                                <p>{{$merchant['data']['phone-number'] ?? ''}}</p>
                                                            @endisset
                                                            @isset($object['data']['userPhone1'])
                                                                <p>{{$object['data']['userPhone1'] ?? ''}}</p>
                                                            @endisset

                                                            @isset($merchant['data']['phone-number'])
                                                                <p>{{$merchant['data']['phone-number'] ?? ''}}</p>
                                                            @endisset
                                                            @isset($object['data']['userPhone1'])
                                                                <p>{{$object['data']['userPhone1'] ?? ''}}</p>
                                                            @endisset
                                                            @isset($object['data']['userPhone2'])
                                                                <p>{{$object['data']['userPhone2'] ?? ''}}</p>
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="home-card-right-section-third">
                                                    <div class="home-card-right-section-third-first">
                                                        <p>{{T("Baxış sayı")}}:</p>
                                                        <p>{{($object['seen']+1) ?? 1}}</p>
                                                    </div>

                                                    <div class="home-card-right-section-third-second">
                                                        <p>{{T("Tarix")}}:</p>
                                                        <p>{{date('d.m.Y', strtotime($object['data']['create-date'] ?? ''))}}</p>
                                                    </div>

                                                    <div class="home-card-right-section-third-third">
                                                        <p>{{T("Yeniləndi")}}:</p>
                                                        <p>{{isset($object['data']['last-modification-date']) ? date('d.m.Y', strtotime($object['data']['last-modification-date'] ?? '')) : date('d.m.Y', strtotime($object['data']['create-date'] ?? ''))}}</p>
                                                    </div>
                                                </div>

                                                <div class="home-card-right-section-fouth">
                                                    <div class="home-card-right-section-fouth-first">
                                                        @if(in_array($id,$inFavoritesList))
                                                            <i class="fas fa-star"
                                                               onclick="removeSelectedList('{{$id}}',this)"></i>
                                                            <p>{{T("Seçilmişlərə əlavə edilib")}}</p>
                                                        @else
                                                            <i class="far fa-star"
                                                               onclick="addSelectedList('{{$id}}',this)"></i>
                                                            <p>{{T("Seçilmişlərə əlavə et")}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="home-card-right-section-fouth-second">
                                                        @if(in_array($id,$inCompareList))
                                                            <i class="fas fa-exchange-alt"
                                                               onclick="removeCompareList('{{$id}}',this)"></i>
                                                        @else
                                                            <i class="fal fa-exchange-alt"
                                                               onclick="addCompareList('{{$id}}',this)"></i>
                                                        @endif
                                                        <p>{{T("Müqayisə et")}}</p>
                                                    </div>
                                                </div>

                                                <div class="home-card-right-section-fifth">
                                                    <div class="home-card-right-section-fifth-first">
                                                        <p>{{T("Alıcı üçün xidmət haqqı yoxdur.")}}</p>
                                                    </div>

                                                    <div class="home-card-right-section-fifth-second">
                                                        <p>{{T("Bütün əmlaklar Evin.az şirkətinə məxsusdur.")}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="home-card-inner-buttons-section">
                                            <div>
                                                <ul class="home-card-inner-ul-buttons">
                                                    <li id="object-info-item-info"
                                                        class="home-card-inner-ul-button-data active">{{T("Məlumat")}}
                                                    </li>
                                                    <li id="object-info-item-plan"
                                                        class="home-card-inner-ul-button-plan"> {{T("Mənzil planı")}}
                                                    </li>
                                                    <li id="object-info-item-map"
                                                        onclick="initMapCommon('object-page-map-item', '{{@$object['data']['map-lat']??''}}', '{{@$object['data']['map-lat']??''}}')"
                                                        class="home-card-inner-ul-buttons-last">{{T("Xəritə")}}
                                                    </li>
                                                </ul>

                                                <div class="home-card-inner-ul-buttons-drop-down">
                                                    <ul class="home-card-inner-ul-btn-mobile custom-common-select">
                                                        <li class="home-card--ul-button-data-drop-down">
                                                            <p>{{T("Məlumat")}}</p><i
                                                                class="fas fa-caret-down"></i></li>
                                                            <ul class="form-div-list">
                                                                <li id="object-info-item-info-mob"
                                                                    class="home-card-inner-ul-button-plan-drop-down home-card-inner-ul-button-drop-down">
                                                                    {{T("Məlumat")}}
                                                                </li>
                                                                <li id="object-info-item-plan-mob"
                                                                    class="home-card-inner-ul-button-map-drop-down home-card-inner-ul-button-drop-down">
                                                                    {{T("Mənzil planı")}}
                                                                </li>
                                                                <li id="object-info-item-map-mob"
                                                                    onclick="initMapCommon('object-page-map-item', '{{@$object['data']['map-lat']??''}}', '{{@$object['data']['map-lat']??''}}')"
                                                                    class="home-card-inner-ul-button-last-drop-down home-card-inner-ul-button-drop-down">
                                                                    {{T("Xəritə")}}
                                                                </li>
                                                            </ul>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="home-card-inner-buttons-table-main container">

                                                <div id="object-page-info-item"
                                                     class="home-card-inner-buttons-table-main-info object-page-info-item">


                                                    <div class="home-card-inner-buttons-section-information">
                                                        <h4>
                                                            {{FallBackLanguage(@getAnnouncementTypeName(@$object['data']['announcement-type'])['data']['title'])}}

                                                            {{@$object['data']['total-room-count']}} {{T("otaqlı")}}
                                                            {{FallBackLanguage(@getAnnouncementObjectTypeName(@$object['data']['announcement-object-type'])['data']['title'])}}
                                                            {{@$object['data']['area']}} <span
                                                                class='fa-1x'>m<sup>2</sup><span>
                                                            ,
                                                            @if(isset($object['data']['metro']))
                                                                {{FallBackLanguage(getMetroName(@$object['data']['metro'])['data']['title'])}}
                                                            @elseif(isset($object['data']['marker']))
                                                                {{@FallBackLanguage(getMarkerName(@$object['data']['marker'])['data']['title'])}}
                                                            @else
                                                                {{FallBackLanguage(@getProvienceName(@$object['data']['provience'])['data']['title'])}}
                                                            @endif

                                                        </h4>

                                                        <div class="home-card-inner-buttons-section-information-table">
                                                            <div
                                                                class="home-card-inner-buttons-section-information-table-left">
                                                                @if(isset($object['data']['area']))
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Ümumi sahə")}}</p>
                                                                        <p>{{@$object['data']['area']}} m<sup>2</sup></p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['current-floor']) && isset($object['data']['total-floors']))
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Mərtəbə")}}</p>
                                                                        <p>{{@$object['data']['current-floor']}}/{{@$object['data']['total-floors']}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['bedroom-count']) && $object['data']['bedroom-count'] > 0)
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Yataq otağı")}}</p>
                                                                        <p>{{($object['data']['bedroom-count'])}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['total-room-count']))
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Ümumi otaq sayı")}}</p>
                                                                        <p>{{(@$object['data']['total-room-count'] ?? 0)}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['sanitar-count']))
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Sanitar qovşaq sayı")}}</p>
                                                                        <p>{{(@$object['data']['sanitar-count'] ?? 0)}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['has-barter']))
                                                                    <div class="home-card-inner-table-left">
                                                                        <p>{{T("Barter")}}</p>
                                                                        <p>{{(@$object['data']['has-barter'] ?? false) ? 'Mümkündür' : 'Mümkün deyil'}}</p>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div
                                                                class="home-card-inner-buttons-section-information-table-right">
                                                                @if(isset($object['data']['has-barter']))
                                                                    <div class="home-card-inner-table-right">
                                                                        <p>{{T("Qaraj")}}</p>
                                                                        <p>{{@($object['data']['has-garage'] ?? false) ? 'Var' : 'Yoxdur'}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['document-type']))
                                                                    <div class="home-card-inner-table-right">
                                                                        <p>{{T("Sənədin tipi")}}</p>
                                                                        <p>{{@\App\Models\DocumentType::find($object['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? ''}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['document-type']))
                                                                    <div class="home-card-inner-table-right">
                                                                        <p>{{T("İpoteka")}}</p>
                                                                        <p>{{@\App\Models\IpotechType::find($object['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? ''}}</p>
                                                                    </div>
                                                                @endif
                                                                @if(isset($object['data']['has-internet']))
                                                                    <div class="home-card-inner-table-right">
                                                                        <p>{{T("İnternet")}}</p>
                                                                        <p>{{(@$object['data']['has-internet'] ?? false) ? 'Var' : 'Yoxdur'}}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="home-card-inner-table-definition">
                                                        <h3>{{T("Açıqlama")}}</h3>
                                                        <div>
                                                            {!! @FallBackLanguage($object['data']['description']) ?? '' !!}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="object-page-plane-item"
                                                     class="home-card-inner-table-image object-page-info-item">
                                                    @foreach($object['data']['blueprint'] ?? [] as $valueImg)
                                                        <div class="nav-slider-card" style="margin-bottom: 10px;">
                                                            <img
                                                                src="http://evinaznew.cms.kube.tisserv.net/upload/resize/700/700/{{$valueImg['path'] ?? ''}}"
                                                                alt="">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div id="object-page-map-item" style="width: 730px; height: 500px;"
                                                     class="home-card-inner-table-map object-page-info-item">
                                                </div>

                                                <div class="home-card-inner-table-additional">
                                                    <div class="home-card-inner-share">
                                                        <p>{{T("Paylaş")}}:</p>
                                                        <a class="facebook"
                                                           href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}"
                                                           target="_blank"><i class="fab fa-facebook-square"></i></a>
                                                    </div>

                                                    <!-- <div class="home-card-inner-complain">
                                                        <i class="fas fa-flag"></i>
                                                        <p>Elanı şikayət et</p>
                                                    </div> -->
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                    <div class="home-card-right-section object-web-element">
                                        <div class="home-card-right-section-first">
                                            <div
                                                class="home-card-right-section-first-sell">{{\App\Models\AnnouncementType::find($object['data']['announcement-type'])['data']['title'][App::getLocale()] ?? ''}}</div>
                                            <div
                                                class="home-card-right-section-first-price price-dots">{{@$object['data']['price']}} {{@\App\Models\CurrencyType::find($object['data']['currency'])['data']['title'][App::getLocale()] ?? ''}}</div>
                                        </div>

                                        <div class="home-card-right-section-second">
                                            <div class="home-card-right-section-second-first-row">
                                                <i class="fas fa-user"></i>
                                                <div>
                                                    @isset($merchant['data']['fullname'])
                                                        <p>{{$merchant['data']['fullname'] ?? ''}}</p>
                                                    @endisset
                                                    @isset($object['data']['userFullName'])
                                                        <p>{{$object['data']['userFullName'] ?? ''}}</p>
                                                    @endisset
                                                    <p class="indirect">
                                                        ({{\App\Models\MerchantType::find($merchant['data']['type'] ?? '')['data']['title'][App::getLocale()] ?? ''}}
                                                        )</p>
                                                </div>
                                            </div>

                                            <div class="home-card-right-section-second-second-row">
                                                <i class="fas fa-phone-volume"></i>
                                                <div>
                                                    @isset($merchant['data']['phone-number'])
                                                        <p>{{$merchant['data']['phone-number'] ?? ''}}</p>
                                                    @endisset
                                                    @isset($object['data']['userPhone1'])
                                                        <p>{{$object['data']['userPhone1'] ?? ''}}</p>
                                                    @endisset

                                                    @isset($merchant['data']['phone-number'])
                                                        <p>{{$merchant['data']['phone-number'] ?? ''}}</p>
                                                    @endisset
                                                    @isset($object['data']['userPhone1'])
                                                        <p>{{$object['data']['userPhone1'] ?? ''}}</p>
                                                    @endisset
                                                    @isset($object['data']['userPhone2'])
                                                        <p>{{$object['data']['userPhone2'] ?? ''}}</p>
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>

                                        <div class="home-card-right-section-third">
                                            <div class="home-card-right-section-third-first">
                                                <p>{{T("Baxış sayı")}}:</p>
                                                <p>{{($object['seen']+1) ?? 1}}</p>
                                            </div>

                                            <div class="home-card-right-section-third-second">
                                                <p>Tarix:</p>
                                                <p>{{date('d.m.Y', strtotime($object['data']['create-date'] ?? ''))}}</p>
                                            </div>

                                            <div class="home-card-right-section-third-third">
                                                <p>Yeniləndi:</p>
                                                <p>{{isset($object['data']['last-modification-date']) ? date('d.m.Y', strtotime($object['data']['last-modification-date'] ?? '')) : date('d.m.Y', strtotime($object['data']['create-date'] ?? ''))}}</p>
                                            </div>
                                        </div>

                                        <div class="home-card-right-section-fouth">
                                            <div class="home-card-right-section-fouth-first">
                                                @if(in_array($id,$inFavoritesList))
                                                    <i class="fas fa-star"
                                                       onclick="removeSelectedList('{{$id}}',this)"></i>
                                                    <p>{{T("Seçilmişlərə əlavə edilib")}}</p>
                                                @else
                                                    <i class="far fa-star"
                                                       onclick="addSelectedList('{{$id}}',this)"></i>
                                                    <p>{{T("Seçilmişlərə əlavə et")}}</p>
                                                @endif
                                            </div>
                                            <div class="home-card-right-section-fouth-second">
                                                @if(in_array($id,$inCompareList))
                                                    <i class="fas fa-exchange-alt"
                                                       onclick="removeCompareList('{{$id}}',this)"></i>
                                                @else
                                                    <i class="fal fa-exchange-alt"
                                                       onclick="addCompareList('{{$id}}',this)"></i>
                                                @endif
                                                <p>{{T("Müqayisə et")}}</p>
                                            </div>
                                        </div>

                                        <div class="home-card-right-section-fifth">
                                            <div class="home-card-right-section-fifth-first">
                                                <p>{{T("Alıcı üçün xidmət haqqı yoxdur.")}}</p>
                                            </div>

                                            <div class="home-card-right-section-fifth-second">
                                                <p>{{T("Bütün əmlaklar Evin.az şirkətinə məxsusdur.")}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="home-card-inner-lower-section">
                        <div class="home-card-inner-lower-section-title custom__lower-title">
                            <p>Oxşar elanlar</p>
                        </div>

                        <div class="home-card-inner-lower-section-cards mb-5">
                            @foreach($similar as $value)
                                <div class="home-inner-card mb-3 vip-card object-container"
                                     data-id="{{$value['_id']}}"
                                     data-link="{{langUrlPrefix()}}/object/">
                                    <div class="vip-card-header">
                                        <div class="vip-card-header-data-btn-container">
                                            @if(!empty($value['data']['document-type']) && $value['data']['document-type'] == '60bdf0671f35a21fd8f3d4be')
                                                <button class="vip-card-header-data-btn blue">
                                                    {{T("ÇIXARIŞLI")}}
                                                </button>
                                            @endif
                                            @if(!empty($value['data']['ipotech-type']))
                                                <button class="vip-card-header-data-btn red">
                                                    {{T("İPOTEKA VAR")}}
                                                </button>
                                            @endif
                                        </div>
                                        <div class="vip-card-slider">
                                            @foreach($value['data']['images'] ?? [] as $valueImg)
                                                <figure>
                                                    <img
                                                        class="w-100"
                                                        src="http://evinaznew.cms.kube.tisserv.net/upload/{{$valueImg['path'] ?? ''}}"
                                                        alt="">
                                                </figure>
                                            @endforeach
                                        </div>
                                        <div class="home-inner-card-title">
                                            <h5 class=" d-sm-block d-none">
                                                @if(isset($value['data']['metro']))
                                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                                @elseif(isset($value['data']['marker']))
                                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                                @else
                                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                                @endif
                                            </h5>
                                             <div
                                                 class="w-100 flex-wrap mobileCard border-bottom font-weight-bold mt-3 d-sm-none d-block px-3 d-flex justify-content-between">
                                                <h4 class="price-dots">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                <p class="date-mob-footer">
                                                    <span class="d-sm-inline d-none">{{\App\Models\City::find($value['data']['city'])->data['title'][App::getLocale()] ?? ''}},</span>
                                                    @isset($value['data']['create-date']) {{date('d.m.Y', strtotime($value['data']['create-date']))}} @endisset
                                                </p>
                                            </div>
                                        </div>
                                          <div>
                                            <h5 class="custom-card-title fa-1x font-weight-bold line-clamb line-1 mt-2 d-sm-none d-block">
                                                @if(isset($value['data']['metro']))
                                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                                @elseif(isset($value['data']['marker']))
                                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                                @else
                                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="home-inner-card-content">
                                            <div class="home-inner-first-row w-100 ml-0">
                                                <div class="d-sm-flex px-3 mt-2 w-100 d-none">
                                                    <div class='mr-3'>
                                                        <span class="item-hidden-icon"><img src="/assets/icons/room.svg"
                                                                                            alt=""></span>
                                                        <p class="custom__before-dot">
                                                            {{@$value['data']['total-room-count']}}
                                                            {{T("otaq")}}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <span class="item-hidden-icon"><img src="/assets/icons/area.svg"
                                                                                            alt=""></span>
                                                        <p class="custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                            &#13217;</p>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="d-sm-none  d-flex flex-wrap justify-content-between first-row">
                                                <div>
                                                    <span class="item-hidden-icon">
                                                        <img src="/assets/icons/room.svg" alt="">
                                                    </span>
                                                    <p class="f-12 custom__before-dot">
                                                        {{@$value['data']['total-room-count']}}
                                                        {{T("otaq")}}
                                                    </p>
                                                </div>

                                                <div>
                                                    <span class="item-hidden-icon"><img src="/assets/icons/area.svg"
                                                                                        alt=""></span>
                                                    <p class="f-12 custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                        &#13217;
                                                    </p>
                                                </div>


                                              <div class="ml-0">
                                                    <span class="item-hidden-icon"><img src="/assets/icons/floor.svg"
                                                                                        alt=""></span>
                                                    <p class="f-12 custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                        <span>{{T("mərtəbə")}}</span>
                                                    </p>
                                                </div>

                                            </div>

                                            <div
                                                class="home-inner-second-row justify-content-between custom__second-row px-3">
                                                <div class='d-sm-flex d-none'>
                                                    <span class="item-hidden-icon">
                                                        <img src="/assets/icons/floor.svg" alt="">
                                                    </span>
                                                    <p class="custom__before-dot"> {{@$value['data']['current-floor']}}/{{@$value['data']['total-floors']}}
                                                       <span class="floor-span">{{T("mərtəbə")}}</span>
                                                    </p>
                                                </div>

                                                <div
                                                    class="home-inner-date custom__card-date d-sm-block d-none object-date">
                                                    <p>{{\App\Models\City::find(@$value['data']['city'])->data['title'][App::getLocale()] ?? ''}},
                                                    {{date('d.m.Y', strtotime($value['data']['create-date'] ?? ''))}}</p>
                                                </div>
                                            </div>

                                            <div class="home-inner-third-row custom__card-footer "
                                                 style="margin-bottom: 10px">
                                                <h4 class="price-dots d-sm-block d-none">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                <div>
                                                    <button class="starButton" style="border-radius: 16px">
                                                        @if(in_array($value['_id'],$inFavoritesList))
                                                            <i class="fas fa-star"
                                                               onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                                        @else
                                                            <i class="far fa-star"
                                                               onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                                        @endif
                                                    </button>
                                                    <button class="starButton" style="border-radius: 16px">
                                                        @if(in_array($value['_id'],$inCompareList))
                                                            <i class="fas fa-exchange-alt"
                                                               onclick="removeCompareList('{{$value['_id']}}',this)"></i>
                                                        @else
                                                            <i class="fal fa-exchange-alt"
                                                               onclick="addCompareList('{{$value['_id']}}',this)"></i>
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{--                        <div class="inner-card-pages-flex">--}}
                            {{--                            <div class="inner-card-pages">--}}

                            {{--                                <button><i class="fas fa-chevron-left"></i></button>--}}

                            {{--                                <div class="inner-card-pages-left">--}}
                            {{--                                    <ul>--}}
                            {{--                                        <li>1</li>--}}
                            {{--                                        <li>2</li>--}}
                            {{--                                        <li>...</li>--}}
                            {{--                                        <li>14</li>--}}
                            {{--                                        <li>15</li>--}}
                            {{--                                    </ul>--}}
                            {{--                                </div class="inner-card-pages-right">--}}

                            {{--                                <button><i class="fas fa-chevron-right"></i></button>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </section>

            {{--            <section class="complain-home-card-inner-sect">--}}
            {{--                <div class="inner-home-card-complain-section">--}}
            {{--                    <div class="inner-home-card-complain-section-title">--}}
            {{--                        <p>Elanı şikayət et</p>--}}

            {{--                        <div>--}}
            {{--                            <i class="fas fa-times"></i>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    <div class="inner-home-card-complain-section-main-one">--}}
            {{--                        <div class="catagory">--}}
            {{--                            <p>Kateqoriya</p>--}}
            {{--                            <i class="fas fa-caret-down"></i>--}}
            {{--                        </div>--}}

            {{--                        <div class="inner-home-card-complain-section-complain">--}}
            {{--                            <p>Şikayətiniz</p>--}}
            {{--                            <textarea name="" id="" rows="7"></textarea>--}}
            {{--                        </div>--}}

            {{--                        <div class="inner-home-card-complain-section-button">--}}
            {{--                            <button>Göndər</button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    <div class="inner-home-card-complain-section-main-two">--}}
            {{--                        <h4>Şikayətiniz qeydə alındı</h4>--}}
            {{--                        <p>Şikayətiniz əməkdaşlarımız tərəfindən incələnəcək. Bizə dəstək olduğunuz üçün təşəkkür edirik</p>--}}
            {{--                        <button>Bağla</button>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </section>--}}
        </article>
    </main>
@endsection
