@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/order-flat/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection
<?php
$province = !empty($request->input('province')) ? explode(',',$request->input('province')) : [];
$marker = !empty($request->input('marker')) ? explode(',',$request->input('marker')) : [];
$metro = !empty($request->input('metro')) ? explode(',',$request->input('metro')) : [];
$countOfAreas = count($province)+count($marker)+count($metro);
echo $countOfAreas == 0 ? '' : '('.$countOfAreas.')';
?>
@section('content')
    <main>
        <article>
            <section>
                @if(!$isPosted)
                    <div class="booking-container container">
                        <div class="booking-title">
                            <h3>Mənzil sifariş et</h3>
                        </div>

                        <div class="booking-content">
                            <div class="booking-table-box">
                                <table class="booking-table">
                                    <h3 class="booking-table-title">Qaydalar</h3>
                                    <tr class="booking-table-tr">
                                        <td class="booking-table-td first-td">1) Lorem Ipsum xəttatlıq və çap
                                            sənayesində istifadə olunan, qarışıq mətnlər toplusudur. Lorem Ipsum adı
                                            məlum olmayan mətbəə işçisinin 1500-cü illərdə nümunə mətinlərin
                                        </td>
                                        <td class="booking-table-td second-td">2) Lorem Ipsum xəttatlıq və çap
                                            sənayesində istifadə olunan, qarışıq mətnlər toplusudur. Lorem Ipsum adı
                                            məlum olmayan mətbəə işçisinin 1500-cü illərdə nümunə mətinlərin yaradılması
                                            üçün heca
                                        </td>
                                    </tr>

                                    <tr class="booking-table-tr">
                                        <td class="booking-table-td third-td">3) Lorem Ipsum xəttatlıq və çap
                                            sənayesində istifadə olunan, qarışıq mətnlər toplusudur. Lorem Ipsum adı
                                            məlum olmayan mətbəə işçisinin 1500-cü illərdə nümunə mətinlərin
                                        </td>
                                        <td class="booking-table-td forth-td">4) Lorem Ipsum xəttatlıq və çap
                                            sənayesində istifadə olunan, qarışıq mətnlər toplusudur. Lorem Ipsum adı
                                            məlum olmayan mətbəə işçisinin 1500-cü illərdə nümunə mətinlərin yaradılması
                                            üçün heca
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="booking-form-box">
                                <div>
                                    <form action="" class="booking-form" method="post">
                                        @csrf
                                        <div class="booking-form-div-row">
                                            <div class="booking-form-div custom-common-select">
                                                <p>Satış</p>
                                                <i class="fas fa-caret-down"></i>
                                                <ul class="form-div-list">
                                                    <li id="1" data-value="1" class="form-div-item">123</li>
                                                    <li id="2" data-value="2" class="form-div-item">123</li>
                                                    <li id="3" data-value="3" class="form-div-item">123</li>
                                                </ul>
                                                <input type="hidden" name="satis">
                                            </div>
                                            <div class="booking-form-div custom-common-select">
                                                <p>Əmlak tipi</p>
                                                <i class="fas fa-caret-down"></i>
                                                <ul class="form-div-list">
                                                    <li id="1" data-value="1" class="form-div-item">123</li>
                                                    <li id="2" data-value="2" class="form-div-item">123</li>
                                                    <li id="3" data-value="3" class="form-div-item">123</li>
                                                </ul>
                                                <input type="hidden" name="emlakTipi">
                                            </div>
                                        </div>

                                        <div class="booking-form-card">
                                            <p>Qiymət, AZN</p>
                                            <div class="input-container">
                                                <input type="number" class="booking-detail-input left" placeholder="Min"
                                                       name="priceMin">
                                                <input type="number" class="booking-detail-input right"
                                                       placeholder="Max" name="priceMax">
                                            </div>
                                        </div>

                                        <div class="booking-form-card">
                                            <p>Əmlak sahəsi, (m&#178)</p>
                                            <div class="input-container">
                                                <input type="number" class="booking-detail-input left" placeholder="Min"
                                                       name="areaMin">
                                                <input type="number" class="booking-detail-input right"
                                                       placeholder="Max" name="areaMax">
                                            </div>
                                        </div>

                                        <div class="booking-form-div-container">
                                            <div class="booking-form-div custom-common-select"
                                                 id="booking-form-destructor">
                                                <p>Təmir statusu</p>
                                                <i class="fas fa-caret-down"></i>
                                                <ul class="form-div-list">
                                                    @foreach($maintenancys as $item)
                                                        <li id="{{$item['_id']}}" data-value="{{$item['_id']}}" class="form-div-item">{{$item['data']['title'][app()->getLocale()]}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="temirStatus">
                                            </div>
                                            <div class="booking-form-div order-flat-location-btn" id="location"><i
                                                        class="fas fa-map-marker-alt"></i>Ərazi
                                            </div>
                                        </div>

                                        <div>
                                            <button class="booking-form-button">Göndər</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="success-send-container">
                        <img src="./assets/images/success-send.svg" alt="" class="success-send-img">
                        <p class="success-send-title">Göndərildi</p>
                        <p class="success-send-text success-send-text-main">
                            Sizin müraciətiniz göndərildi. Sorğunuza uyğun təkliflər üzrə sizə geri dönüş ediləcək.
                        </p>
                        {{--                    <p class="success-send-text success-send-text-note">--}}
                        {{--                        Elanınızın nömrəsini itirməyin!--}}
                        {{--                    </p>--}}
                    </div>
                @endif
            </section>
        </article>
    </main>

    <div class="map-popup-bg" id="order-flat-map-popup-bg">
        <div class="map-popup">
            <div class="map-popup-header">
                <div class="map-popup-header-list">
                    <button id="rayon" class="map-popup-header-btn active">
                        Rayon və qəsəbələr
                    </button>
                    <button id="metro" class="map-popup-header-btn">
                        Metrostansiyalar
                    </button>
                    <button id="tag" class="map-popup-header-btn">
                        Nişangahlar
                    </button>
                </div>

                <button class="map-popup-header-close-btn">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <div class="map-popup-content" id="map-popup-rayon">
                <div class="search-input-wrapper">
                    <div class="search-input-container">
                        <input type="text" placeholder="Stansiya axtar" class="search-input">
                    </div>
                </div>
                <div class="map-container">
                    <div class="tag-list-wrapper">
                        <ul class="tag-list">
                            <li class="tag-item">
                                <p class="tag-item-header">Rayon</p>
                                @foreach ($provinces as $key=>$value)
                                    <div data-id="{{$key}}" id="{{$key}}"
                                         class="home-popup-list-item provinces {{in_array($key,$province) ? 'active' : ''}}">
                                        <p class="home-search-popup-list-input-text">{{$value['data']['title'][App::getLocale()] ?? ''}}</p>
                                        <button data-id="{{$key}}"
                                                class="home-search-popup-close-btn provinces">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                        <input id="provinces-hidden-input" type="hidden" name="province" value="{{$request->input('province')}}">
                    </div>
                </div>
            </div>

            <div class="map-popup-content" id="map-popup-metro">

                <div class="search-input-wrapper">
                    <input type="text" placeholder="Stansiya axtar" class="search-input">
                </div>

                <div class="map-container">
                    <img class="metro-map" src="/assets/images/metro-map.svg" alt="">
                    @foreach ($metroStations as $value)
                        <label
                            class="metro-label {{$metroStationsPositionClassesOnView[$value['data']['key']]}} {{$value['data']['key']}}">
                            <input type="checkbox" data-id="{{$value['_id']}}" id="{{$value['data']['key']}}"
                                   class="metro-checkbox" {{in_array($value['_id'],$metro) ? 'checked' : ''}}>
                            <span class="checkbox-mask"></span>
                            <span class="metro-label-text">{{$value['data']['title'][App::getLocale()] ?? ''}}</span>
                        </label>
                    @endforeach
                    <input type="hidden" id="metroStations-hidden-input" name="metro" value="{{$request->input('metro')}}">
                </div>
            </div>

            <div class="map-popup-content" id="map-popup-tag">
                <div class="search-input-wrapper">
                    <input type="text" placeholder="Stansiya axtar" class="search-input">
                </div>
                <div class="map-container">
                    <div class="tag-list-wrapper">
                        <ul class="tag-list">
                            <li class="tag-item">
                                <p class="tag-item-header">Tag</p>
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
                        <input type="hidden" id="markers-hidden-input" name="marker" value="{{$request->input('marker')}}">
                    </div>
                </div>
            </div>

            <div class="map-footer">
                <div class="selected-item-row">
                    <div class="selected-item-row-left">
                        @foreach($metroStations as $value)
                            @if(in_array($value['_id'],$metro))
                                <div class="map-selected-item">{{$value['data']['title'][App::getLocale()]}}<button class="map-selected-close">x</button></div>
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


@endsection
