@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/home/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
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
        <article>
            <section class="searching-section">
                <div class="searching-div">
                    <div class="searc-buttons">
                        <button class="search-btn">{{T("Axtarış")}}</button>
                        <button class="compare-btn">{{T("Pulsuz qiymətləndirmə")}}</button>
                    </div>

                    <div class="search-form-container custom__search-container">
                        <div class="search-form custom__search-form">
                            <div class="form-div custom-common-select custom__form-item" id="first-div">
                                <?php $titleFound = false; $contentHtml = '';
                                foreach ($announcementTypes as $value): ?>
                                @if(($request->input('announcementType') ?? '') == $value['_id'])
                                    <?php $titleFound = $value['data']['title'][App::getLocale()] ?? ''?>
                                @endif
                                <?php
                                $liTitle = $value["data"]["title"][App::getLocale()] ?? "";
                                $contentHtml .= '<li class="form-div-item"
                                        data-value="' . $value["_id"] . '">' . $liTitle . '</li>';
                                ?>
                                <?php endforeach; ?>
                                <p>{{$titleFound ? $titleFound : 'Satılır'}}</p>
                                <i class="fas fa-caret-down"></i>
                                <ul class="form-div-list select-list">
                                    <?=$contentHtml?>
                                </ul>
                                <input type="hidden" name="announcementType"
                                       value="{{$request->input('announcementType') ?? ''}}">
                            </div>
                            <div class="form-div custom-common-select custom__form-item">
                                <?php $titleFound = false; $contentHtml = '';
                                foreach ($announcementObjectTypes as $value): ?>
                                @if(($request->input('objectType') ?? '') == $value['_id'])
                                    <?php $titleFound = $value['data']['title'][App::getLocale()] ?? ''?>
                                @endif
                                <?php
                                $liTitle = $value["data"]["title"][App::getLocale()] ?? "";
                                $contentHtml .= '<li class="form-div-item"
                                        data-value="' . $value["_id"] . '">' . $liTitle . '</li>';
                                ?>
                                <?php endforeach; ?>
                                <p>{{$titleFound ? $titleFound : 'Əmlak növü'}}</p>
                                <i class="fas fa-caret-down"></i>
                                <ul class="form-div-list select-list">
                                    <?=$contentHtml?>
                                </ul>
                                <input type="hidden" name="objectType" value="{{$request->input('objectType') ?? ''}}">
                            </div>
                            <div class="form-div custom-common-select custom__form-item">
                                <p>
                                    @if(!empty($request->input('roomCount')??''))
                                        {{$request->input('roomCount') == '9999' ? 'İstənilən qədər' : $request->input('roomCount')}}
                                    @else
                                        Otaq sayı
                                    @endif
                                </p>
                                <i class="fas fa-caret-down"></i>
                                <ul class="form-div-list select-list">
                                    <li class="form-div-item" data-value="9999">{{T("İstənilən qədər")}}</li>
                                    <li class="form-div-item" data-value="1">1</li>
                                    <li class="form-div-item" data-value="2">2</li>
                                    <li class="form-div-item" data-value="3">3</li>
                                    <li class="form-div-item" data-value="4">4</li>
                                    <li class="form-div-item" data-value="5">5</li>
                                </ul>
                                <input type="hidden" name="roomCount" value="{{$request->input('roomCount') ?? ''}}">
                            </div>
                            <div class="form-div location-map-btn custom__form-item" id="location">
                                <i class="fas fa-map-marker-alt"></i>
                                Ərazi
                                <?php
                                $province = !empty($request->input('province')) ? explode(',', $request->input('province')) : [];
                                $marker = !empty($request->input('marker')) ? explode(',', $request->input('marker')) : [];
                                $metro = !empty($request->input('metro')) ? explode(',', $request->input('metro')) : [];
                                $countOfAreas = count($province) + count($marker) + count($metro);
                                echo $countOfAreas == 0 ? '' : '(' . $countOfAreas . ')';
                                ?>
                            </div>
                            <button class="form-div custom__form-item" id="about-search">{{T("Ətraflı axtar")}}</button>
                            <button type="submit" class="form-div-button submitSearchForm custom__form-item"
                                    id="last-div">{{T("Axtar")}}</button>
                        </div>

                        <div class="details-searching">
                            <div class="details-searching-first details-searching-inner">
                                <div class="details-card">
                                    <p>Qiymət, AZN</p>
                                    <div class="input-container">
                                        <input type="number" class="detail-input left" placeholder="Min" name="priceMin"
                                               value="{{$request->input('priceMin') ?? ''}}">
                                        <input type="number" class="detail-input right" placeholder="Max"
                                               name="priceMax" value="{{$request->input('priceMax') ?? ''}}">
                                    </div>
                                </div>

                                <div class="details-card">
                                    <p>{{T("Mərtəbə sayı")}}</p>
                                    <div class="input-container">
                                        <input type="number" class="detail-input left" placeholder="Min" name="floorMin"
                                               value="{{$request->input('floorMin') ?? ''}}">
                                        <input type="number" class="detail-input right" placeholder="Max"
                                               name="floorMax" value="{{$request->input('floorMax') ?? ''}}">
                                    </div>
                                </div>

                                <div class="details-card">
                                    <p>{{T("Tikili sahəsi")}}</p>
                                    <div class="input-container">
                                        <input type="number" class="detail-input left" placeholder="Min" name="areaMin"
                                               value="{{$request->input('areaMin') ?? ''}}">
                                        <input type="number" class="detail-input right" placeholder="Max" name="areaMax"
                                               value="{{$request->input('areaMax') ?? ''}}">
                                    </div>
                                </div>

                                <div class="details-card-one details-card">
                                    <p>{{T("Torpaq sahəsi")}}</p>
                                    <div class="input-container">
                                        <input type="number" class="detail-input left" placeholder="Min"
                                               name="landAreaMin" value="{{$request->input('landAreaMin') ?? ''}}">
                                        <input type="number" class="detail-input right" placeholder="Max"
                                               name="landAreaMax" value="{{$request->input('landAreaMax') ?? ''}}">
                                    </div>
                                </div>

                                {{--                                <div class="details-card">--}}
                                {{--                                    <div>--}}
                                {{--                                        <input type="checkbox" class="detail-input checkbox-detail">--}}
                                {{--                                        <label for="">Barter mümkündür</label>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>

                            <div class="details-searching-second details-searching-inner">


                                <div class="details-card">
                                    <div
                                        class="details-card-inner details-card-destructor details-card-destructor-one custom-common-select">
                                        <?php $titleFound = false; $contentHtml = '';
                                        foreach ($maintainancyStatuses as $value): ?>
                                        @if(($request->input('repairStatus') ?? '') == $value['_id'])
                                            <?php $titleFound = $value['data']['title'][App::getLocale()] ?? ''?>
                                        @endif
                                        <?php
                                        $liTitle = $value["data"]["title"][App::getLocale()] ?? "";
                                        $contentHtml .= '<li class="form-div-item"
                                                data-value="' . $value["_id"] . '">' . $liTitle . '</li>';
                                        ?>
                                        <?php endforeach; ?>
                                        <p>{{$titleFound ? $titleFound : 'Təmir statusu'}}</p>
                                        <i class="fas fa-caret-down"></i>
                                        <ul class="form-div-list">
                                            <?=$contentHtml?>
                                        </ul>
                                        <input type="hidden" name="repairStatus"
                                               value="{{$request->input('repairStatus') ?? ''}}">
                                    </div>
                                </div>

                                <div class="details-card">
                                    <div
                                        class="details-card-inner details-card-document details-card-destructor-two custom-common-select">
                                        <?php $titleFound = false; $contentHtml = '';
                                        foreach ($documentTypes as $value): ?>
                                        @if(($request->input('documentType') ?? '') == $value['_id'])
                                            <?php $titleFound = $value['data']['title'][App::getLocale()] ?? ''?>
                                        @endif
                                        <?php
                                        $liTitle = $value["data"]["title"][App::getLocale()] ?? "";
                                        $contentHtml .= '<li class="form-div-item"
                                                data-value="' . $value["_id"] . '">' . $liTitle . '</li>';
                                        ?>
                                        <?php endforeach; ?>
                                        <p>{{$titleFound ? $titleFound : 'Əmlak sənədi'}}</p>
                                        <i class="fas fa-caret-down"></i>
                                        <ul class="form-div-list">
                                            <?=$contentHtml?>
                                        </ul>
                                        <input type="hidden" name="documentType"
                                               value="{{$request->input('documentType') ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="value-form">
                        <div class="value-form-first">

                            <div>
                                <div class="value-form-div custom-common-select" id="first-form-div">
                                    <p>{{T("Vəziyyəti")}}</p>
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="form-div-list select-list">
                                        @foreach($maintenancys as $item)
                                            <li id="{{$item['_id']}}" data-value="{{$item['_id']}}"
                                                class="form-div-item">{{$item['data']['title'][App::getLocale()] ?? ''}}</li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="temirStatus">
                                </div>
                                <div class="value-form-div custom-common-select">
                                    <p>{{T("Otaq sayı")}}</p>
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="form-div-list select-list">
                                        <li data-value="1" class="form-div-item">1</li>
                                        <li data-value="2" class="form-div-item">2</li>
                                        <li data-value="3" class="form-div-item">3</li>
                                        <li data-value="4" class="form-div-item">4</li>
                                        <li data-value="5" class="form-div-item">5</li>
                                        <li data-value="9999" class="form-div-item">{{T("daha çox")}}</li>
                                    </ul>
                                    <input type="hidden">
                                </div>
                                <input type="number" placeholder="Ölçü (Kv.m)"
                                       class="value-form-input mob-location-value">
                            </div>

                            <div>
                                {{--                                <div class="value-form-div custom-common-select">--}}
                                {{--                                    <p>Ölçü (Kv.m)</p>--}}
                                {{--                                    <i class="fas fa-caret-down"></i>--}}
                                {{--                                    <ul class="form-div-list">--}}
                                {{--                                        <li class="form-div-item">123</li>--}}
                                {{--                                        <li class="form-div-item">123</li>--}}
                                {{--                                        <li class="form-div-item">123</li>--}}
                                {{--                                    </ul>--}}
                                {{--                                    <input type="hidden">--}}
                                <input type="number" placeholder="Ölçü (Kv.m)"
                                       class="value-form-input desk-location-value">
                                {{--                                </div>--}}
                                <div class="value-form-div location-map-btn location-map-btn-web" id="location-value"><i
                                        class="fas fa-map-marker-alt"></i>{{T("Ərazi")}}
                                </div>
                            </div>

                            <div class="radio-section" id="last-form-div">

                                <label>
                                    <input type="radio" id="sell" class="radio-input-value" name="selected">
                                    <span class="input-mask"></span>
                                    <span>{{T("Satıram")}}</span>
                                </label>
                                <label>
                                    <input type="radio" id="interest" class="radio-input-value" name="selected">
                                    <span class="input-mask"></span>
                                    <span>{{T("Maraqlıdır")}}</span>
                                </label>
                                <label>
                                    <input type="radio" id="buy" class="radio-input-value" name="selected">
                                    <span class="input-mask"></span>
                                    <label for="buy">{{T("Alıram")}}</label>
                                </label>
                            </div>


                            <div class="value-form-div location-map-btn location-map-btn-mobile" style="width: 95px !important; margin-left: auto;" id="location-value"><i
                                    class="fas fa-map-marker-alt"></i>{{T("Ərazi")}}
                            </div>

                            {{--                            <div class="mobile-forms">--}}
                            {{--                                <input type="text" class="mob-input" style="width: 100% !important;" placeholder="Ad və soyadınız">--}}
                            {{--                                <input type="text" id="home-phone-number-mask" style="width: 100% !important;" oninput="setHomeNumberValueToHidden()"--}}
                            {{--                                       class="mob-input"--}}
                            {{--                                       placeholder="Mobil nömrə">--}}
                            {{--                                <input type="hidden" id="home-phone-number-hidden" name="name">--}}
                            {{--                                <input type="mail" class="mob-input" style="width: 100% !important;" placeholder="Email">--}}
                            {{--                                <button type="submit" style="width: 100% !important;" class="send-button-value">{{T("Göndər")}}</button>--}}
                            {{--                            </div>--}}

                            <input type="text" class="value-form-input mob-input home-mob-input" placeholder="Ad və soyadınız">
                            <input type="text" id="home-phone-number-mask" oninput="setHomeNumberValueToHidden()"
                                   class="value-form-input mob-input home-mob-input"
                                   placeholder="Mobil nömrə">
                            <input type="hidden" id="home-phone-number-hidden" name="name">
                            <div class="some-grid-class">
                                <input type="mail" class="value-form-input mob-input home-mob-input" placeholder="Email">
                                <button type="submit" class="send-button-value">{{T("Göndər")}}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section>
                <div class='advertisement-column'>
                    <article>
                        <section class="elanlar">
                            <div>
                                <div id="left-hand-advertisement">
                                    <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                                </div>
                            </div>

                            <div class="allAdver">
                                @if(count($vip) > 0)
                                    <div class="vip-title custom__vip-title">
                                        <div class="vip-paragraph">
                                            <p>{{T("VIP Elanlar")}}</p>
                                        </div>
                                        <div class="vip-addition">
                                            <p onclick="location.href='{{langUrlPrefix()}}/vip'">{{T("Hamısına bax")}}<i
                                                    class="fas fa-arrow-right"></i></p>
                                        </div>
                                    </div>

                                    <div class="vip-flex-cards custom__flex-cards">
                                        @foreach($vip as $value)
                                            <div class="vip-card object-container col-xs-12 custom__card-container"
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
                                                    <div class="vip-card-slider  custom__card-slider">
                                                        @foreach($value['data']['images'] ?? [] as $valueImg)
                                                            <figure>

                                                                    <img
                                                                        class="w-100"
                                                                        src="http://evinaznew.cms.kube.tisserv.net/upload/{{$valueImg['path'] ?? ''}}"
                                                                        alt="">
                                                            </figure>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="vip-card-title">
                                                    <h5 class="custom-card-title  d-sm-block d-none">
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
                                                <div class="vip-card-content">
                                                    <div class="d-sm-block  d-none">
                                                        <div class="vip-first-row first-row">
                                                            <div>
                                                                <span class="item-hidden-icon">
                                                                    <img src="/assets/icons/room.svg" alt="">
                                                                </span>
                                                                <p class=" custom__before-dot">
                                                                    {{@$value['data']['total-room-count']}}
                                                                    {{T("otaq")}}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <span class="item-hidden-icon"><img
                                                                        src="/assets/icons/area.svg" alt=""></span>
                                                                <p class=" custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                                    &#13217;
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="d-sm-none d-flex flex-wrap justify-content-between first-row">
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
                                                            <span class="item-hidden-icon"><img
                                                                    src="/assets/icons/area.svg" alt=""></span>
                                                            <p class="f-12 custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                                &#13217;
                                                            </p>
                                                        </div>

                                                      <div class="ml-0">
                                                            <span class="item-hidden-icon"><img src="/assets/icons/floor.svg" alt=""></span>
                                                            <p class="f-12 custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                <span>{{T("mərtəbə")}}</span>
                                                            </p>
                                                        </div>

                                                    </div>

                                                    <div class="vip-second-row second-row custom__second-row">
                                                        <div class='d-sm-flex d-none'>
                                                            <span class="item-hidden-icon"><img
                                                                    src="/assets/icons/floor.svg" alt=""></span>
                                                            <p class="custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                <span>{{T("mərtəbə")}}</span>
                                                            </p>
                                                        </div>

                                                        <div class="vip-date custom__card-date">
                                                            <p><span class="d-sm-inline d-none">{{\App\Models\City::find($value['data']['city'])->data['title'][App::getLocale()] ?? ''}},</span>
                                                                @isset($value['data']['create-date']) {{date('d.m.Y', strtotime($value['data']['create-date']))}} @endisset
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="vip-third-row third-row custom__card-footer">
                                                        <h4 class="price-dots pl-2 d-sm-block d-none">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                        <div>
                                                            <button>
                                                                @if(in_array($value['_id'],$inFavoritesList))
                                                                    <i class="fas fa-star"
                                                                       onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                                                @else
                                                                    <i class="far fa-star"
                                                                       onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                                                @endif
                                                            </button>
                                                            <button>
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
                                        @endforeach
                                    </div>
                                @endif

                                @if(count($rent) > 0)
                                    <div class="rent-section">
                                        <div class="rent-cards-section">
                                            <div class="rent-title">
                                                <div class="rent-paragraph">
                                                    <p>{{T("Kirayə evlər")}}</p>
                                                </div>
                                                <div class="rent-addition">
                                                    <p onclick="location.href='{{langUrlPrefix()}}/rent'">{{T("Hamısına bax")}}
                                                        <i
                                                            class="fas fa-arrow-right"></i></p>
                                                </div>
                                            </div>
                                            <div class="rent-cards-all custom__flex-cards">
                                                @foreach($rent as $value)
                                                    <div class="rent-card object-container custom__card-container"
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
                                                                            src="http://evinaznew.cms.kube.tisserv.net/upload/{{$valueImg['path'] ?? ''}}"
                                                                            alt="">
                                                                    </figure>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="rent-card-title">
                                                            <h5 class="custom-card-title  d-sm-block d-none">
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
                                                        <div class="rent-card-content pt-sm-3 pt-1">
                                                            <div class="d-sm-block  d-none">
                                                                <div class="rent-first-row first-row custom-card-content-item">
                                                                    <div>
                                                                        <span class="item-hidden-icon"><img src="/assets/icons/room.svg" alt=""></span>
                                                                        <p>
                                                                            {{@$value['data']['total-room-count']}}
                                                                            {{T("otaq")}}
                                                                        </p>
                                                                    </div>

                                                                    <div>
                                                                        <span class="item-hidden-icon"><img src="/assets/icons/area.svg" alt=""></span>
                                                                        <p>{{$value['data']['area'] ?? ''}}  &#13217;</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                             <div class="d-sm-none d-flex flex-wrap justify-content-between first-row">
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
                                                                    <span class="item-hidden-icon"><img src="/assets/icons/area.svg" alt=""></span>
                                                                    <p class="f-12 custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                                        &#13217;
                                                                    </p>
                                                                </div>


                                                              <div class="ml-0 ">
                                                                    <span class="item-hidden-icon"><img src="/assets/icons/floor.svg" alt=""></span>
                                                                    <p class="f-12 custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                        <span>{{T("mərtəbə")}}</span>
                                                                    </p>
                                                                </div>

                                                            </div>


                                                            <div
                                                                class="rent-second-row second-row custom-card-content-item">
                                                                <div class="d-sm-flex d-none">
                                                                    <span class="item-hidden-icon"><img
                                                                            src="/assets/icons/floor.svg" alt=""></span>
                                                                    <p>{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                        <span class="floor-span">{{T("mərtəbə")}}</span>
                                                                    </p>
                                                                </div>


                                                                <div class="rent-date custom__card-date">
                                                                    <p><span class="d-sm-inline d-none">{{\App\Models\City::find($value['data']['city'])->data['title'][App::getLocale()] ?? ''}},</span>
                                                                        {{date('d.m.Y', strtotime($value['data']['create-date']))}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="rent-third-row third-row custom__card-footer">
                                                                <h4 class="d-sm-block pl-2 d-none price-dots">{{$value['data']['price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                                <div>
                                                                    <button>
                                                                        @if(in_array($value['_id'],$inFavoritesList))
                                                                            <i class="fas fa-star"
                                                                               onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                                                        @else
                                                                            <i class="far fa-star"
                                                                               onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                                                        @endif
                                                                    </button>
                                                                    <button>
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
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(count($lastest) > 0)
                                    <div>
                                        <div class="latest-section">
                                            <div class="latest-title">
                                                <div class="latest-paragraph">
                                                    <p>{{T("Ən son elanlar")}}</p>
                                                </div>
                                                <div class="latest-addition">
                                                    <p onclick="location.href='{{langUrlPrefix()}}/last'">{{T("Hamısına bax")}}
                                                        <i
                                                            class="fas fa-arrow-right"></i></p>
                                                </div>
                                            </div>

                                            <div class="latest-flex-cards custom__flex-cards">
                                                @foreach($lastest as $value)
                                                    <div class="latest-card object-container custom__card-container"
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
                                                            <div class="vip-card-slider custom__card-slider">
                                                                @foreach($value['data']['images'] ?? [] as $valueImg)
                                                                    <figure>
                                                                        <img
                                                                            src="http://evinaznew.cms.kube.tisserv.net/upload/{{$valueImg['path'] ?? ''}}"
                                                                            alt="">
                                                                    </figure>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="latest-card-title">
                                                          <h5 class="custom-card-title  d-sm-block d-none">
                                                              @if(isset($value['data']['metro']))
                                                                  {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                                              @elseif(isset($value['data']['marker']))
                                                                  {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                                              @else
                                                                  {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                                              @endif
                                                          </h5>
                                                          <div class= "w-100 flex-wrap mobileCard border-bottom font-weight-bold mt-3 d-sm-none d-block px-3 d-flex justify-content-between">
                                                              <h4 class="price-dots">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                                 <p class="date-mob-footer">
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
                                                        <div class="latest-card-content  pt-sm-3 pt-1">
                                                          <div class="d-sm-block  d-none">
                                                                <div class="latest-first-row first-row custom-card-content-item">
                                                                    <div>
                                                                        <span class="item-hidden-icon"><img src="/assets/icons/room.svg" alt=""></span>
                                                                        <p>
                                                                            {{@$value['data']['total-room-count']}}
                                                                            {{T("otaq")}}
                                                                        </p>
                                                                    </div>

                                                                    <div>
                                                                        <span class="item-hidden-icon"><img src="/assets/icons/area.svg" alt=""></span>
                                                                        <p>{{$value['data']['area'] ?? ''}} &#13217;</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                              <div class="d-sm-none d-flex flex-wrap justify-content-between first-row">
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
                                                                    <span class="item-hidden-icon"><img src="/assets/icons/area.svg" alt=""></span>
                                                                    <p class="f-12 custom__before-dot">{{$value['data']['area'] ?? ''}}
                                                                        &#13217;
                                                                    </p>
                                                                </div>


                                                              <div class="ml-0">
                                                                    <span class="item-hidden-icon"><img src="/assets/icons/floor.svg" alt=""></span>
                                                                    <p class="f-12 custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                        <span>{{T("mərtəbə")}}</span>
                                                                    </p>
                                                                </div>

                                                            </div>


                                                            <div
                                                                class="latest-second-row second-row custom-card-content-item">
                                                                <div class='d-sm-flex d-none'>
                                                                    <span class="item-hidden-icon"><img
                                                                            src="/assets/icons/floor.svg" alt=""></span>
                                                                    <p>{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                                                        <span class="floor-span">{{T("mərtəbə")}}</span>
                                                                    </p>
                                                                </div>

                                                                <div class="latest-date custom__card-date">
                                                                    <p><span class="d-sm-inline d-none">{{\App\Models\City::find($value['data']['city'])->data['title'][App::getLocale()] ?? ''}},</span>
                                                                        @isset($value['data']['create-date']) {{date('d.m.Y', strtotime($value['data']['create-date']))}} @endisset</p>
                                                                </div>
                                                            </div>

                                                            <div class="latest-third-row third-row custom__card-footer">
                                                                <h4 class="d-sm-block pl-2 d-none price-dots">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                                                <div>
                                                                    <button>
                                                                        @if(in_array($value['_id'],$inFavoritesList))
                                                                            <i class="fas fa-star"
                                                                               onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                                                        @else
                                                                            <i class="far fa-star"
                                                                               onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                                                        @endif
                                                                    </button>
                                                                    <button>
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
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(count($residence) > 0)
                                    <div>
                                        <div class="complex-section">
                                            <div class="complex-title">
                                                <div class="complex-paragraph">
                                                    <p>{{T("Yaşayış kompleksləri")}}</p>
                                                </div>
                                                <div class="complex-addition">
                                                    <p onclick="location.href='{{langUrlPrefix()}}/residence'">{{T("Hamısına bax")}}
                                                        <i
                                                            class="fas fa-arrow-right"></i></p>
                                                </div>
                                            </div>

                                            <div class='complex-flex-cards custom__flex-cards'>
                                                @foreach($residence as $value)
                                                    <div class="complex-card object-container custom__card-container"
                                                         data-id="{{$value['_id']}}"
                                                         data-link="{{langUrlPrefix()}}/residence/">

                                                      <div class="complex-card-image">
                                                        <div class="vip-card-header">
                                                            <div class="vip-card-slider">
                                                                @foreach($value['data']['images'] ?? [] as $valueImg)
                                                                    <figure>
                                                                        <img
                                                                            src="http://evinaznew.cms.kube.tisserv.net/upload/{{$valueImg['path'] ?? ''}}"
                                                                            alt="">
                                                                    </figure>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                            <div class="complex-card-price full">
                                                                <h5 class="price-dots">{{$value['data']['start-price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}
                                                                    -dən</h5>
                                                            </div>
                                                      </div>


                                                        <div class="complex-card-title">
                                                            <h5>{{$value['data']['adress'] ?? ''}}</h5>
                                                        </div>

                                                        <div class="card-list">
                                                            <ul>
                                                                <li>
                                                                    <img src="/assets/icons/construction.svg"
                                                                         alt="">{{$value['data']['fullname']}}
                                                                </li>
                                                                @if($value['data']['metro'] ?? false)
                                                                    <li>
                                                                        <img src="/assets/icons/train.svg"
                                                                             alt="">{{\App\Models\Metro::find($value['data']['metro'])->data['title'][App::getLocale()] ?? ''}}
                                                                    </li>
                                                                @endif
                                                                @if($value['data']['marker'] ?? false)
                                                                    <li>
                                                                        <img src="/assets/icons/place-mark.svg"
                                                                             alt="">{{\App\Models\Marker::find($value['data']['marker'])->data['title'][App::getLocale()] ?? ''}}
                                                                    </li>
                                                                @endif
                                                                @if($value['data']['is-finished'] ?? false)
                                                                    <li>
                                                                        <img src="/assets/icons/key.svg"
                                                                             alt="">{{T("Təhvil verilib")}}
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <div class="agency-section">
                                        <div class="agency-title">
                                            <div class="agency-paragraph">
                                                <p>{{T("Agentliklər")}}</p>
                                            </div>
                                            <div class="agency-addition">
                                                <p onclick="location.href='{{langUrlPrefix()}}/agency'">{{T("Hamısına bax")}}
                                                    <i
                                                        class="fas fa-arrow-right"></i></p>
                                            </div>
                                        </div>

                                        <div class="agency-flex-cards custom__flex-cards">
                                            @foreach($agency as $value)
                                                <div class="agency-card custom__card-container"
                                                     onclick="location.href='{{langUrlPrefix()}}/agency/{{$value['_id']}}'">
                                                    <h4>{{$value['data']['fullname'] ?? ''}}</h4>
                                                    <p class="agency-phone">{{$value['data']['phone-number'] ?? ''}}</p>
                                                    <p class="agency-adress">{{$value['data']['adress'] ?? ''}}</p>
                                                    <button
                                                        class="request-btn">{{\App\Models\Announcement::where('data.status', 'ACTIVE')->where('data.merchant', $value['_id'])->count()}}
                                                        {{T("Təklif")}}
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div id="right-hand-advertisement">
                                    <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                                </div>
                            </div>
                        </section>
                </div>
            </section>
        </article>


        {{--        <article>--}}
        {{--            <div class="data-box">--}}
        {{--                <div class="data-box-first">--}}
        {{--                    <div class="data-box-first-p">--}}
        {{--                        <p>Məlumat</p>--}}
        {{--                    </div>--}}
        {{--                    <div  class="fa-times-div"><i class="fas fa-times"></i></div>--}}
        {{--                </div>--}}
        {{--                <div class="data-box-second">--}}
        {{--                    <p>Yalnız 3 elanı müqayisə etmək mümkündür.</p>--}}
        {{--                </div>--}}
        {{--                <div class="data-box-third">--}}
        {{--                    <button>Bağla</button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </article>--}}
    </main>

    <div class="map-popup-bg">
        <div class="map-popup">
            <div class="map-popup-header">
                <div class="map-popup-header-list">
                    <button id="rayon" class="map-popup-header-btn active">
                        {{T("Rayon və qəsəbələr")}}
                    </button>
                    <button id="metro" class="map-popup-header-btn">
                        {{T("Metrostansiyalar")}}
                    </button>
                    <button id="tag" class="map-popup-header-btn">
                        {{T("Nişangahlar")}}
                    </button>
                </div>

                <button class="map-popup-header-close-btn">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <div class="map-popup-content" id="map-popup-rayon">
                <div class="search-input-wrapper">
                    <div class="search-input-container">
                      <div class="form-div d-none custom-common-select custom__form-item">
                            <p>
                              Bakı
                            </p>
                            <i class="fas fa-caret-down"></i>
                            <ul class="form-div-list select-list">
                                <li class="form-div-item" data-value="">Bakı</li>
                                <li class="form-div-item" data-value="">Bakı</li>
                                <li class="form-div-item" data-value="">Bakı</li>
                                <li class="form-div-item" data-value="">Bakı</li>
                                <li class="form-div-item" data-value="">Bakı</li>
                                <li class="form-div-item" data-value="">Bakı</li>
                            </ul>
                            <input type="hidden" name="roomCount" value="{{$request->input('roomCount') ?? ''}}">
                        </div>
                        <input type="text" oninput="placeSearchInput(this)" placeholder="Stansiya axtar"
                               class="search-input">
                        <div class="search-input-list">

                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Binəqədi" id="some-1"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Binəqədi</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Mərdəkan" id="some-2"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Mərdəkan</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Nərimanov" id="some-3"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Nərimanov</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Nəsimi" id="some-4" class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Nəsimi</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Sabunçu" id="some-5" class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Sabunçu</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Səbail" id="some-6" class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Səbail</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Xəzər" id="some-7" class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Xəzər</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Mərdəkan" id="some-8"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Mərdəkan</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Nərimanov" id="some-9"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Nərimanov</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Nəsimi" id="some-10" class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Nəsimi</span>
                            </label>
                            <label class="search-input-list-item">
                                <input type="checkbox" data-text="Sabunçu" id="some-11"
                                       class="search-checkbox-checkbox">
                                <span class="search-checkbox-mask"></span>
                                <span class="search-checkbox-text">Sabunçu</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <div class="tag-list-wrapper">
                        <ul class="tag-list">
                            <li class="tag-item">
                                <p class="tag-item-header">{{T("Rayon")}}</p>
                                @foreach ($provinces as $key=>$value)
                                    <div data-id="{{$key}}" id="{{$key}}"
                                         class="home-popup-list-item provinces {{in_array($key,$province) ? 'active' : ''}}">
                                        <p class="home-search-popup-list-input-text">{{$value['data']['title'][App::getLocale()] ?? ''}}</p>
                                        <button data-id="{{$key}}" class="home-search-popup-close-btn provinces">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                        <input id="provinces-hidden-input" type="hidden" name="province"
                               value="{{$request->input('province')}}">
                    </div>
                </div>
            </div>

            <div class="map-popup-content" id="map-popup-metro">

                <div class="search-input-wrapper">
                    <div class="search-input-container">
                        <input type="text" placeholder="Stansiya axtar" class="search-input">
                    </div>
                </div>

                <div class="map-container">
                    <div class="map-container-inner">
                        <img class="metro-map" src="/assets/images/metro-map.svg" alt="">
                        @foreach ($metroStations as $value)
                            <label
                                class="metro-label {{$metroStationsPositionClassesOnView[$value['data']['key']]}} {{$value['data']['key']}}">
                                <input type="checkbox" data-id="{{$value['_id']}}" id="{{$value['data']['key']}}"
                                       class="metro-checkbox" {{in_array($value['_id'],$metro) ? 'checked' : ''}}>
                                <span class="checkbox-mask"></span>
                                <span
                                    class="metro-label-text">{{$value['data']['title'][App::getLocale()] ?? ''}}</span>
                            </label>
                        @endforeach
                        <input type="hidden" id="metroStations-hidden-input" name="metro"
                               value="{{$request->input('metro')}}">
                    </div>
                </div>
            </div>

            <div class="map-popup-content" id="map-popup-tag">
                <div class="search-input-wrapper">
                    <div class="search-input-container">
                        <input type="text" placeholder="Stansiya axtar" class="search-input">
                    </div>
                </div>
                <div class="map-container">
                    <div class="tag-list-wrapper">
                        <ul class="tag-list">
                            <li class="tag-item">
                                <p class="tag-item-header">{{T("Tag")}}</p>
                                @foreach ($markers as $key=>$value)
                                    <div data-id="{{$key}}" id="{{$key}}"
                                         class="home-popup-list-item markers {{in_array($key,$marker) ? 'active' : ''}}">
                                        <p class="home-search-popup-list-input-text">{{$value['data']['title'][App::getLocale()] ?? ''}}</p>
                                        <button data-id="{{$key}}" class="home-search-popup-close-btn markers">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                        <input type="hidden" id="markers-hidden-input" name="marker"
                               value="{{$request->input('marker')}}">
                    </div>
                </div>
            </div>

            <div class="map-footer">
                <div class="selected-item-row">
                    <div class="selected-item-row-left">
                        @foreach($metroStations as $value)
                            @if(in_array($value['_id'],$metro))
                                <div class="map-selected-item">{{$value['data']['title'][App::getLocale()] ?? ''}}
                                    <button class="map-selected-close">x</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="selected-item-row-right">
                        <button id="reset" class="reset-btn">{{T("Reset")}}</button>
                        <button id="confirm" class="confirm-btn">{{T("Confirm")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setHomeNumberValueToHidden() {
            setTimeout(() => {
                let number = $('#home-phone-number-mask').val();
                number = number.replace(/\-/g, '');
                number = number.replace("(", '');
                number = number.replace(")", '');
                $('#home-phone-number-hidden').val(+number);
            }, 5)
        }

        var element = document.getElementById('home-phone-number-mask');
        var maskOptions = {
            mask: '(000)-000-00-00',
        };
        var mask = IMask(element, maskOptions);
    </script>

@endsection


