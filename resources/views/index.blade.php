@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale());
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{asset('assets/home/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    @yield('header')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>@yield('title','Ana səhifə')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <meta name="selected-count" value="{{count((array)json_decode(Session::get('selected') ?? '[]'))}}">
    <meta name="compare-count" value="{{count((array)json_decode(Session::get('compare') ?? '[]'))}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/imask"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmuy79KEiGsKJR5hiueSfAtaXuwcHgpwI"></script>

    <script lang="appliction/javascript">
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
</head>
<body>
<div class="marginContent"></div>
<header
    style="background-image: url('http://evinaznew.cms.kube.tisserv.net/upload/{{getSocialAccount()['data']['index-image'][0]['path']}}')">
    <div class="fixedNav">
        <nav>
            <div class="upper-nav">
                <div class="upper-nav-inner">
                    <div class="upper-nav-left">
                        <ul class="change-lang">
                            <li class="az-lang-main"><p class="az-not-abbr-main">@lang('index.'.App::getLocale())</p>
                                <p class="az-abbr-main">{{App::getLocale()}}</p><i class="fas fa-caret-down"></i>
                                <?php
                                $current_lang = "/" . App::getLocale();
                                $current_url = URL::current();
                                $langs = ["az", "en", "ru"]
                                ?>
                                <div class="lang-hidden">
                                    <ul>
                                        <i class="fas fa-caret-up"></i>
                                        @foreach($langs as $lang)
                                            <?php
                                            $lang_url = str_replace($current_lang, "/" . $lang, $current_url);
                                            ?>
                                            <li>
                                                <a href="{{$lang_url}}" class="en-lang" onclick="changeLanguage('en')">
                                                    <p class="en-not-abbr">@lang("index.$lang")</p>
                                                    <p class="en-abbr">{{$lang}}</p>
                                                </a>
                                            </li>
                                        @endforeach

                                </div>
                            </li>
                            <li><a href="{{url(app()->getLocale()."/page/haqqimizda")}}">{{T("Haqqımızda")}}</a></li>
                            <li>
                                <a href="{{url(app()->getLocale()."/page/reklam-yerlesdir")}}">{{T("Reklam yerləşdir")}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="upper-nav-right">
                        <ul>
                            <li class="upper-nav-right-list-item"><a href="{{langUrlPrefix()}}/compare"><i
                                        class="fas fa-exchange-alt"></i>
                                    <p>{{T("Müqayisə et")}} (<span
                                            class="compare-count">{{count((array)json_decode(Session::get('compare') ?? '[]'))}}</span>)
                                    </p></a>
                            </li>
                            <li class="upper-nav-right-list-item"><a href="{{langUrlPrefix()}}/choosed"><i
                                        class="fas fa-star"></i>
                                    <p>{{T("Seçilmişlər")}} (<span
                                            class="selected-count">{{count((array)json_decode(Session::get('selected') ?? '[]'))}}</span>)
                                    </p></a>
                            </li>
                            <li class="upper-nav-right-list-item item-connection"><a href="#">{{T("Əlaqə")}}: (012) 409
                                    08 08</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="lower-nav">
                <div class="lower-nav-inner">

                    <div class="lower-nav-left">
                        <div class="logo">
                            {{--                            <i class="fas fa-home" onclick="location.href='/'"></i>--}}
                            <div onclick="location.href='/az/home'">
                                <img class="header-main-logo" src="/assets/images/evin.az-logo-purple.svg" alt="">
                            </div>

                        </div>

                        <ul class="nav-list-ul">
                            <li class="dropped-item">
                                <a href="#">{{T("Satış")}}</a>
                                <div class="drop-down">
                                    <ul>
                                        <i class="fas fa-caret-up"></i>
                                        @foreach(\App\Models\AnnouncementObjectType::all() as $value)
                                            <li class="drop-down-menu-items"><a
                                                    href="{{langUrlPrefix()}}/sale/{{$value['_id']}}">{{FallBackLanguage($value['data']['title']) ?? ''}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li class="dropped-item">
                                <a href="#">{{T("Kirayə")}}</a>
                                <div class="drop-down">
                                    <ul>
                                        <i class="fas fa-caret-up"></i>
                                        @foreach(\App\Models\AnnouncementObjectType::all() as $value)
                                            <li class="drop-down-menu-items"><a
                                                    href="{{langUrlPrefix()}}/rent/{{$value['_id']}}">{{FallBackLanguage($value['data']['title']) ?? ''}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li><a href="{{Auth::check() ? langUrlPrefix().'/order-flat' : langUrlPrefix().'/login'}}">{{T("Mənzil
                                    sifariş et")}}</a></li>
                            <li><a href="{{langUrlPrefix()}}/repair">{{T("Mənzil təmiri")}}</a></li>
                        </ul>
                    </div>

                    <div class="lower-nav-right">
                        @guest
                            <div class="user-button">
                                <button onclick="location.href='{{langUrlPrefix()}}/login'"><i
                                        class="far fa-user"></i>{{T("Giriş et")}}
                                </button>
                            </div>
                        @else
                            <div class="user-button">
                                <button>{{T("Hesabım")}}</button>
                                <ul class="user-button-list">
                                    <li onclick="location.href='{{langUrlPrefix()}}/profile'" class="user-button-item">
                                        <i class="far fa-user"></i>
                                        <p>{{T("Hesabım")}}</p>
                                    </li>
                                    <li onclick="location.href='{{langUrlPrefix()}}/logout'" class="user-button-item">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <p>{{T("Çıxış")}}</p>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                        @if(Request::segment(2) == "place-ads" || Request::segment(2) == "login" || Request::segment(2) == "register")
{{--                            <div class="adver-button">--}}
{{--                                <button--}}
{{--                                    onclick="location.href='{{langUrlPrefix()}}/place-ads'">{{T("Elan yerləşdir")}}</button>--}}
{{--                            </div>--}}
                            @else
                                                            <div class="adver-button">
                                                                <button
                                                                    onclick="location.href='{{langUrlPrefix()}}/place-ads'">{{T("Elan yerləşdir")}}</button>
                                                            </div>
                        @endif
                    </div>
                    <div class="fa-bars-div">
                        <i class="fas fa-bars"></i>
                    </div>

                </div>
            </div>

            <div class="overlay"></div>
            <div class="hamburger-menu-div">
                <div class="hamburger-menu-div-top">
                    @guest
                        <div class="sign-in-btn"
                             style="display: flex !important; align-content: center; justify-content: space-between">
                            <button onclick="location.href='{{langUrlPrefix()}}/login'">
                                <img src="/assets/icons/mobile-profile.svg" alt="">
                                {{T("Giriş et")}}
                            </button>
                            <div class="fa-times-div"><i class="fas fa-times"></i></div>
                        </div>
                    @else
                        <div class="sign-in-btn">
                            <div>
                                <button id="mobile-account-btn">
                                    <img src="/assets/icons/mobile-profile.svg" alt="">
                                    Hesab
                                </button>

                                <div class="fa-times-div"><i class="fas fa-times"></i></div>
                            </div>

                            <ul class="user-button-list user-button-list-mobile" id="user-button-list-mobile">
                                <li onclick="location.href='{{langUrlPrefix()}}/profile'" class="user-button-item">
                                    <i class="far fa-user"></i>
                                    <p>{{T("Hesabım")}}</p>
                                </li>
                                <li onclick="location.href='{{langUrlPrefix()}}/logout'" class="user-button-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>{{T("Çıxış")}}</p>
                                </li>
                            </ul>

                        </div>
                    @endguest
                    <ul class="hamburger-nav-list-ul">
                        <li class="hamburger-dropped-item "><a href="#">{{T("Satış")}}</a><i
                                class="fas fa-chevron-down"></i></li>
                        <div class="hamburger-drop-down">
                            <ul>
                                @foreach(\App\Models\AnnouncementObjectType::all() as $value)
                                    <li class="hamburger-drop-down-menu-items"><a
                                            href="{{langUrlPrefix()}}/sale/{{$value['_id']}}">{{FallBackLanguage($value['data']['title']) ?? ''}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <li class="hamburger-dropped-item-two"><a href="#">Kirayə</a><i class="fas fa-chevron-down"></i>
                        </li>
                        <div class="hamburger-drop-down-two hamburger-drop-down">
                            <ul>
                                @foreach(\App\Models\AnnouncementObjectType::all() as $value)
                                    <li class="hamburger-drop-down-menu-items"><a
                                            href="{{langUrlPrefix()}}/rent/{{$value['_id']}}">{{$value['data']['title'][App::getLocale()] ?? ''}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <li><a href="{{langUrlPrefix()}}/order-flat">{{T("Mənzil sifariş et")}}</a></li>
                        <li><a href="{{langUrlPrefix()}}/repair">{{T("Mənzil təmiri")}}</a></li>
                    </ul>

                    <ul class="rec-photo-plan">
                        @foreach(getServices() as $value)
                            <li class="hamburger-recording">
                                {{--                            <i class="fas fa-{{$value['data']['iconPath']}}"></i>--}}
                                <a href="{{"/".app()->getLocale()."/services/".FallBackLanguage($value['data']['url'])}}">{{FallBackLanguage($value['data']['title'])}}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <div class="hamburger-menu-div-bottom">

                    <ul class="social-media-hamburger">
                        <li><a href="{{getSocialAccount()['data']['facebookUrl']}}"><i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        <li><a href="{{getSocialAccount()['data']['instagramUrl']}}"><i
                                    class="fab fa-instagram"></i></a>
                        </li>
                        <li><a href="{{getSocialAccount()['data']['facebookUrl']}}"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li><a href="{{getSocialAccount()['data']['youtubenUrl']}}"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>

                </div>


            </div>
        </nav>
    </div>

    <div class="aside-buttons">
        @foreach(getServices() as $value)
            <div class="aside-button">
                <a href="{{"/".app()->getLocale()."/services/".FallBackLanguage($value['data']['url'])}}">
                    {{--                    <i class="fas fa-{{$value['data']['iconPath']}}"></i>--}}
                    {{FallBackLanguage($value['data']['title'])}}
                </a>
            </div>
        @endforeach
    </div>
</header>


@yield('content')
@if(Request::segment(2) == "place-ads" || Request::segment(2) == "login" || Request::segment(2) == "register")
    {{--                            <div class="adver-button">--}}
    {{--                                <button--}}
    {{--                                    onclick="location.href='{{langUrlPrefix()}}/place-ads'">{{T("Elan yerləşdir")}}</button>--}}
    {{--                            </div>--}}
@else
    <div class="mainButton">
        <button
            onclick="location.href='{{langUrlPrefix()}}/place-ads'">{{T("Elan yerləşdir")}}</button>
    </div>
@endif
<footer>
    <div class="footer-section">
        <div class="upper-footer">
            <div class="footer-about">
                <div class="footer-logo">
                    {{--                    <span><i class="fas fa-home" onclick="location.href='/'"></i></span>--}}
                    <div onclick="location.href='/az/home'">
                        <img class="footer-main-logo" src="/assets/images/evin.az-logo-white.svg" alt="">
                    </div>
                    <h4>Evin.az</h4>
                </div>

                <div>
                    <p>{{T("Evin.az daşınmaz əmlakın satış və kirayəsi xidmətlərini digital sferada təqdim edən
                        platformadır.")}}</p>
                </div>
            </div>

            <div class="footer-right-flex">
                <div class="footer-lists  footer-lists-first">
                    <h3>{{T("İstifadəçilərə")}}</h3>
                    <ul class="footer-list">
                        <li onclick="location.href='{{langUrlPrefix()}}/page/istifadeci-razilasmasi'">{{T("İstifadəçi
                            razılaşması")}}</li>
                        <li onclick="location.href='{{langUrlPrefix()}}/page/reklam-yerlesdir'">{{T("Reklam yerləşdir")}}</li>
                        <li onclick="location.href='{{langUrlPrefix()}}/page/haqqimizda'">{{T("Haqqımızda")}}</li>
                        <li onclick="location.href='{{langUrlPrefix()}}/faq'">{{T("FAQ")}}</li>
                    </ul>
                </div>
                <div class="footer-lists">
                    <h3><p class="veb-title">{{T("Qısayollar")}}</p>
                        <p class="mobile-title">{{T("Digər")}}</p></h3>
                    <ul class="footer-list">
                        <li onclick="location.href='{{langUrlPrefix()}}/agency'">{{T("Agentliklər")}}</li>
                        <li onclick="location.href='{{langUrlPrefix()}}/makler'">{{T("Maklerlər")}}</li>
                        <li onclick="location.href='{{langUrlPrefix()}}/business-center'">{{T("Biznes mərkəzləri")}}</li>
                    </ul>
                </div>
                <div class="footer-lists-veb footer-lists">
                    <h3>{{T("Əlaqə")}}</h3>
                    <ul class="footer-list">
                        <li>(012) 409 08 08</li>
                        <li>(050) 554 08 08</li>
                        <li>(077) 554 08 08</li>
                        <li>info@evin.az</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="lower-footer">
            <div class="tradeMark">
                <p>&#169; {{T("All rights reserved 2021. Evin.az")}}</p>
            </div>

            <div class="social-media">
                <ul>
                    <li><a href="{{getSocialAccount()['data']['facebookUrl']}}"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li><a href="{{getSocialAccount()['data']['instagramUrl']}}"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li><a href="{{getSocialAccount()['data']['facebookUrl']}}"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="{{getSocialAccount()['data']['youtubenUrl']}}"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                </ul>
            </div>

            <div>
                <p>Bu bir <span id="pink">Marcom</span> {{T("məhsuludur.")}}</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/imask"></script>
<script src="{{asset('assets/javascript/navbar.js')}}"></script>
{{--<script src="{{asset('assets/javascript/external.js')}}"></script>--}}
<script src="{{asset('assets/javascript/searching.js')}}"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQL7nEkNMbSer8EIW5i-WtQYZUsxoOXm4&callback=initMap"
        type="text/javascript"></script>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('assets/javascript/script.js')}}"></script>
<script>
    const changeLanguage = (language = 'az') => $.get('/change-language/' + language, {}, function () {
        {{--var theUrl = '/'+language+'/{{explode('/',$_SERVER['REQUEST_URI'])[2]}}';--}}
            location.href = theUrl;
    });
    const addSelectedList = (objectId, theElement) => {
        const selectedCount = parseInt($('meta[name="selected-count"]').attr('value'));
        // if(selectedCount >= 3) return false;
        $.get('{{langUrlPrefix()}}/selected/' + objectId, {}, (response) => {
            if (response.status == 'success') {
                $('meta[name="selected-count"]').attr('value', selectedCount + 1);
                $('span.selected-count').text(selectedCount + 1);
                $(theElement).removeClass('far').addClass('fas');
                $(theElement).attr('onclick', $(theElement).attr('onclick').replace('add', 'remove'));
            }
        });
    }
    const removeSelectedList = (objectId, theElement) => {
        const selectedCount = parseInt($('meta[name="selected-count"]').attr('value'));
        // if(selectedCount >= 3) return false;
        $.get('{{langUrlPrefix()}}/selected/remove/' + objectId, {}, (response) => {
            if (response.status == 'success') {
                $('meta[name="selected-count"]').attr('value', selectedCount - 1);
                $('span.selected-count').text(selectedCount - 1);
                $(theElement).removeClass('fas').addClass('far');
                $(theElement).attr('onclick', $(theElement).attr('onclick').replace('remove', 'add'));
            }
        });
    }

    const setProfileInfo = (id) => {
        let data = {
            type: id,
            value: $('#' + id).val()
        }
        $.post('{{langUrlPrefix()}}/edit-profile-info', {data: data, _token: '{{csrf_token()}}'}, (response) => {

        });
    }


    const addCompareList = (objectId, theElement) => {
        const compareCount = parseInt($('meta[name="compare-count"]').attr('value'));
        if (compareCount >= 3) return false;
        $.get('{{langUrlPrefix()}}/compare/' + objectId, {}, (response) => {
            if (response.status == 'success') {
                $('meta[name="compare-count"]').attr('value', compareCount + 1);
                $('span.compare-count').text(compareCount + 1);
                $(theElement).removeClass('fal').addClass('fas');
                $(theElement).attr('onclick', $(theElement).attr('onclick').replace('add', 'remove'));
            }
        });
    }

    const removeCompareList = (objectId, theElement) => {
        const compareCount = parseInt($('meta[name="compare-count"]').attr('value'));
        // if (compareCount >= 3) return false;
        $.get('{{langUrlPrefix()}}/compare/remove/' + objectId, {}, (response) => {
            if (response.status == 'success') {
                $('meta[name="compare-count"]').attr('value', compareCount - 1);
                $('span.compare-count').text(compareCount - 1);
                $(theElement).removeClass('fas').addClass('fal');
                $(theElement).attr('onclick', $(theElement).attr('onclick').replace('remove', 'add'));
            }
        });
    }

    $('#mobile-account-btn').click(function () {
        $('#user-button-list-mobile').toggleClass('active');
    })


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer_compiled.js"
        integrity="sha512-DRb7DDx102X//EZzXafSrvSfM2vsm58IEdTpAlUAJPv27ziyWCoKL25E42yY+GJM6AEtCGzSrsQ9RPGfDnd1Cg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
