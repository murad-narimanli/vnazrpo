@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/residence-detail/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/home/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/residence-detail/mobile.css?cssv=4')}}">
@endsection
@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale())
@endphp

@section('content')
    <main>
        <article>
            <section>
                <div class="agency-container container">
                    <div class="agency-header">
                        {{--                        <div class="agency-header-p">--}}
                        {{--                            <p><a href="#">Satış</a> <span>></span> </p>--}}
                        {{--                            <p><a href="#">Ev elanları</a> <span>></span> </p>--}}
                        {{--                            <p><a href="#">Son elanlar</a></p>--}}
                        {{--                        </div>--}}

                        <div class="agency-header-title">
                            <p>{{T("Elan ID")}}: {{$id}}</p>
                        </div>
                    </div>


                    <div class="agency-main">
                        <div class="agency-main-images-p-section">
                            <div>
                                <div class="agency-main-first">
                                    <div class="agency-main-left-images">
                                        <div class="agency-main-card-inner-main-img-section-wrapper">

                                            <div
                                                class="agency-main-card-inner-main-img-section object-page-slide residence-slider">
                                                @if(isset($residence['data']['images']) && $residence['data']['images'] !=null)
                                                    @foreach($residence['data']['images'] as $image)
                                                        <div class="agency-main-card-inner-main-img">
                                                             <figure>
                                                                <img
                                                                    src="{{"http://evinaznew.cms.kube.tisserv.net/upload/crop/700/641/".@$image['path']}}"
                                                                    alt="">
                                                             </figure>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="agency-nav-slider" >
                                                @foreach($residence['data']['images'] as $image)
                                                    <div class="nav-slider-card">
                                                        <figure>
                                                            <img
                                                                src="{{"http://evinaznew.cms.kube.tisserv.net/upload/crop/107/71/".@$image['path']}}"
                                                                alt="">
                                                        </figure>
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{--                                            <div class="agency-main-card-inner-little-imgs residence-slider-nav">--}}
                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project1.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}

                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project2.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}

                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project3.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}

                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project4.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}

                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project5.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}

                                            {{--                                                <figure>--}}
                                            {{--                                                    <img src="{{asset('assets/images/project6.jpg')}}" alt="">--}}
                                            {{--                                                </figure>--}}
                                            {{--                                            </div>--}}

                                        </div>


                                        <div class="agency-main-card-right-section">
                                            <div class="agency-main-card-right-section-title">
                                                <h1>{{$residence['data']['fullname']}}</h1>
                                            </div>

                                            <div class="agency-main-card-right-section-phone-div">
                                                <div class="agency-main-card-right-section-phone">
                                                    <div class="fa-phone-volume-div">
                                                        <i class="fas fa-phone-volume"></i>
                                                    </div>
                                                    <div class="agency-main-card-right-section-phone-p">
                                                        <p>{{@$residence['data']['phone-number']}}</p>
                                                    </div>
                                                </div>

                                                <div class="agency-main-card-right-section-mail">
                                                    <div class="fa-envelope-div"><i class="fas fa-envelope"></i></div>
                                                    <div><p>{{@$residence['data']['email']}}</p></div>
                                                </div>

                                                <div class="agency-main-card-right-section-vebsite">
                                                    <div class="fa-globe-div"><i class="fas fa-globe"></i></div>
                                                    <div><p>{{@$residence['data']['websilte']}}</p></div>
                                                </div>

                                                @if($residence['data']['is-finished'])
                                                    <div class="agency-main-card-right-section-key">
                                                        <div class="fa-key-div"><i class="fas fa-key"></i></div>
                                                        <div><p>{{T("Təhvil verilib")}}</p></div>
                                                    </div>
                                                @endif

                                                <div class="agency-main-card-right-section-map">
                                                    <div class="fa-map-marker-alt-div"><i
                                                            class="fas fa-map-marker-alt"></i></div>
                                                    <div><p>{{@$residence['data']['adress']}}</p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="agency-main-card-buttons-and-information">
                                        <div class="agency-main-card-buttons">
                                            <ul>
                                                <li data-value="info"
                                                    class="agency-main-card-buttons-data agency-main-card-buttons-item active">
                                                    {{T("Məlumat")}}
                                                </li>
                                                <li data-value="map"
                                                    onclick="initMapCommon('residence-page-map-item', '{{@$object['data']['map-lat']??''}}', '{{@$object['data']['map-lat']??''}}')"
                                                    class="agency-main-card-buttons-map agency-main-card-buttons-item">
                                                    {{T("Xəritə")}}
                                                </li>
                                            </ul>
                                        </div>

                                        <div id="agency-main-card-information-item-info"
                                             class="agency-main-card-information agency-main-card-some-info">

                                            <div class="agency-main-card-buttons-and-additional-information">
                                                <div class="agency-main-card-buttons-and-additional">
                                                    <span><i
                                                            class="fas fa-caret-right"></i><p>{{@$residence['data']['corpuses']}} {{T("korpus")}}</p></span>
                                                </div>

                                                <div class="agency-main-card-buttons-and-additional">
                                                    <span><i
                                                            class="fas fa-caret-right"></i><p>{{@$residence['data']['floors']}} {{T("mərtəbə")}}</p></span>
                                                </div>

                                                <div class="agency-main-card-buttons-and-additional">
                                                    <span><i
                                                            class="fas fa-caret-right"></i><p>{{@$residence['data']['apartments']}} {{T("mənzil")}}</p></span>
                                                </div>

                                                <div class="agency-main-card-buttons-and-additional">
                                                    <span><i
                                                            class="fas fa-caret-right"></i><p>{{@$residence['data']['entrance']}} {{T("blok")}}</p></span>
                                                </div>
                                            </div>

                                            <div class="opportunity-redince-information-section">
                                                <div class="opportunity-redince-information">
{{--                                                    {!! @FallBackLanguage($residence['data']['description']) ?? '' !!}--}}
                                                                                                        Kompleksin əlverişli nöqtədə yerləşməsi Nobel prospektinə rahat
                                                                                                        keçidi təmin edərək oradan eynilə həm şəhərin tarixi mərkəzinə, həm
                                                                                                        də Heydər Əliyev beynəlxalq hava limanına getməyi asanlaşdırır.
                                                                                                        Yaşıl Ada rayonunun cənub hissəsində – Nobel prospekti boyunca 4
                                                                                                        çıxışı olan yeni metro stansiyası planlaşdırılıb. “Spektr İnşaat”
                                                                                                        yaşayış kompleksindən gəzinti məsafəsində yerləşən Dənizkənarı
                                                                                                        Bulvar, Baku City Mall, Fransız məktəbi, Boulevard Hotel və yüksək
                                                                                                        səviyyəli biznes mərkəzləri gələcək sakinlər və qonaqlar üçün gözəl
                                                                                                        mühit yaradır.
                                                                                                        <br>
                                                                                                        <br>
                                                                                                        Qonşuluqda layihələndirilmiş orta məktəblər, parklar, müasir biznes
                                                                                                        və ticarət mərkəzləri “Spektr İnşaat” yaşayış kompleksini yaşamaq
                                                                                                        üçün ən rahat və cəlbedici yerlərdən birinə çevirir.
                                                                                                        <br>
                                                                                                        <br>
                                                                                                        Üstünlüklər
                                                </div>
                                            </div>

                                        </div>

                                        <div style="display: none; width: 730px; height: 500px;"
                                             id="residence-page-map-item"
                                             class="map agency-main-card-some-info agency-main-card-information-item-map home-card-inner-table-map object-page-info-item">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="complex-section">
                                <div class="complex-title">
                                    <div class="complex-paragraph">
                                        <p>{{T("Oxşar elanlar")}}</p>
                                    </div>
                                    <div class="complex-addition">
                                        <p onclick="location.href='{{langUrlPrefix()}}/residence'">{{T("Hamısına bax")}}<i
                                                class="fas fa-arrow-right"></i></p>
                                    </div>
                                </div>

                                <div class="complex-flex-cards residence-mobile-card">
                                    @foreach($similar as $value)
                                        <div class="complex-card object-container"
                                             data-id="{{$value['_id']}}"
                                             data-link="{{langUrlPrefix()}}/residence/">
                                            @if(isset($value['data']['images']) && $value['data']['images'] !=null)
                                                {{--                                                @foreach($value['data']['images'] as $image)--}}
                                                <div class=" complex-card-image">
                                                    <div class="complex-card-header">
                                                      <div class="agency-main-card-inner-main-img">
                                                            <img
                                                                class='mt-5 h-100'
                                                                src="{{"http://evinaznew.cms.kube.tisserv.net/upload/".@$value['data']['images'][0]['path']}}"
                                                                alt="">
                                                        </div>
                                                        <div class="agency-main-card-inner-main-img">
                                                            <img
                                                                class='mt-5 h-100'
                                                                src="{{"http://evinaznew.cms.kube.tisserv.net/upload/".@$value['data']['images'][0]['path']}}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                       <div class="complex-card-price full">
                                                            <h5 class="price-dots">{{@$value['data']['start-price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}
                                                                -dən</h5>
                                                        </div>
                                                </div>

                                                {{--                                                @endforeach--}}
                                            @endif

                                            <div class="complex-card-title">
                                                <h5>{{$value['data']['adress']}}</h5>
                                            </div>

                                            <div class="card-list">
                                                <ul>
                                                    <li><i class="fas fa-tools"></i>{{$value['data']['fullname']}}</li>
                                                    @if($value['data']['metro'] ?? false)
                                                        <li>
                                                            <i class="fas fa-subway"></i>{{\App\Models\Metro::find($value['data']['metro'])->data['title'][App::getLocale()] ?? ''}}
                                                        </li>
                                                    @endif
                                                    @if($value['data']['marker'] ?? false)
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i>{{\App\Models\Marker::find($value['data']['marker'])->data['title'][App::getLocale()] ?? ''}}
                                                        </li>
                                                    @endif
                                                    @if($value['data']['is-finished'])
                                                        <li><i class="fas fa-key"></i>{{T("Təhvil verilib")}}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="inner-card-pages-flex">
                                    {{--                                <div class="inner-card-pages">--}}
                                    {{--                                    <button><i class="fas fa-chevron-left"></i></button>--}}

                                    {{--                                    <div class="inner-card-pages-left">--}}
                                    {{--                                        <ul>--}}
                                    {{--                                            <li>1</li>--}}
                                    {{--                                            <li>2</li>--}}
                                    {{--                                            <li>...</li>--}}
                                    {{--                                            <li>14</li>--}}
                                    {{--                                            <li>15</li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </div class="inner-card-pages-right">--}}

                                    {{--                                    <button><i class="fas fa-chevron-right"></i></button>--}}
                                    {{--                                </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </article>
    </main>

    <script>
        $(document).ready(function () {
            const arr = $('.price-dots')
            for (let i = 0; i < arr.length; i++) {
                const el = arr[i];
                let text = el.textContent;
                text = text ? text.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
                $('.price-dots').text(text);
            }
        })

    </script>
@endsection
