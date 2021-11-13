@extends('index')

@section('header')
    {{--    <link rel="stylesheet" href="{{asset('assets/place-ads/style.css?cssv=4')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/elan/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script>
        var userId = '{{$user['_id']}}'
    </script>
@endsection

@section('content')
    <main>
        <br>
        <div class="ad-header">
            <div class="container">
                <p class="add-header-text">
                    Elan yerləşdir
                </p>
            </div>
        </div>

        <div class="ad-container-wrapper">
            <div class="container">
                <form action="" class="ad-form">
                    <div class="ad-form-inner">
                        <div class="ad-section">
                            <div class="block-list">
                                @foreach($adverseTypes as $adverseType)
                                    <a href="#" data-id="{{$adverseType['_id']}}"
                                       class="block-item adverse-type package-item-trigger adv-type">
                                        <div class="block-item-header">
                                            <p class="block-item-header-text">{{$adverseType['data']['title']['az']}}</p>
                                        </div>
                                        <div class="block-item-content">
                                            <p class="block-item-content-text">
                                                {{$adverseType['data']['description']['az']}}
                                            </p>
                                            {{--                                            <p class="block-item-content-link">--}}
                                            {{--                                                Ətraflı məlumat--}}
                                            {{--                                            </p>--}}
                                        </div>
                                    </a>
                                @endforeach
                                <input type="hidden" id="place-ads-package-item-input" name="adverse-type" required
                                       value="{{$adverseTypes[0]['_id']}}">
                            </div>
                            <p class="ad-title">{{T("Əlaqə")}}</p>
                            <div class="contact-container">
                                <div class="input-container">
                                    <p class="input-label">{{T("Ad, soyad*")}}</p>
                                    <input placeholder="Ad və soyadınız" type="text" required class="input"
                                           name="userFullName">
                                </div>
                                <div class="checkbox-container-wrapper">
                                    <label class="checkbox-container">
                                        <input type="radio" name="ad-type" class="checkbox" value="owner">
                                        <span class="checkbox-mask checkbox-mask-radio"></span>
                                        <span class="checkbox-label">{{T("Öz elanımdır")}}</span>
                                    </label>
                                    <label class="checkbox-container">
                                        <input type="radio" name="ad-type" class="checkbox" value="agent">
                                        <span class="checkbox-mask checkbox-mask-radio"></span>
                                        <span class="checkbox-label">{{T("Vasitəçiyəm (agent)")}}</span>
                                    </label>
                                </div>
                                <div>
                                    <div class="input-container">
                                        <p class="input-label">{{T("Telefon*")}}</p>
                                        <div class="prefix-container">
                                            <p class="prefix">+994</p>
                                            <input placeholder="Telefon nömrəniz"
                                                   type="text"
                                                   class="phone-input"
                                                   required
                                                   oninput="setHomeNumberValueToHidden()"
                                                   id="place-ads-phone-input-1"
                                                   name="userPhone1Mask">
                                            <input type="hidden" name="userPhone1" id="place-ads-phone-input-1-hidden">
                                        </div>
                                    </div>
                                    <div class="input-container" id="second-phone">
                                        <div class="prefix-container">
                                            <p class="prefix">+994</p>
                                            <input name="userPhone2Mask"
                                                   oninput="setHomeNumberValueToHiddenSecond()"
                                                   id="place-ads-phone-input-2"
                                                   placeholder="Telefon nömrəniz" type="text" class="phone-input">
                                            <input type="hidden" name="userPhone2" id="place-ads-phone-input-2-hidden">
                                        </div>
                                    </div>
                                    <button type="button" id="add-phone" class="add-phone">
                                        + {{T("İkinci telefon əlavə et")}}
                                    </button>
                                </div>

                                <div class="input-container">
                                    <p class="input-label">{{T("Elektron poçt*")}}</p>
                                    <input placeholder="Elektron poçt*" required type="text" class="input"
                                           name="userEmail">
                                </div>
                            </div>
                        </div>

                        <div class="ad-section">
                            <p class="ad-title">Elan</p>
                            <div class="ad-content-container">
                                <div class="ad-content-item">
                                    <p class="ad-content-label">{{T("Əmlakın növü*")}}</p>
                                    <div class="ad-content-value">

                                        <div>
                                            <div class="custom-ad-select custom-common-select">
                                                <div class="select-header">
                                                    <p class="select-header-text">{{T("Seç")}}</p>
                                                    <img src="{{asset('assets/elan/down-arrow.svg')}}"
                                                         style="width: 10px;"
                                                         alt="">
                                                </div>
                                                <ul class="select-list property-type-class" id="dropdown-hover">
                                                    @foreach(\App\Models\AnnouncementObjectType::all() as $value)
                                                        <li class="select-list-item"
                                                            data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" id="announcement-object-type"
                                                       name="announcement-object-type">
                                            </div>
                                            <p id="announcement-object-type-error" style="position: absolute;"
                                               class="ads-error-text">Please fill out this</p>
                                        </div>

                                        <div>
                                            <div class="custom-ad-select custom-common-select">
                                                <div class="select-header">
                                                    <p class="select-header-text">Seç</p>
                                                    <img src="{{asset('assets/elan/down-arrow.svg')}}"
                                                         style="width: 10px;"
                                                         alt="">
                                                </div>
                                                <ul class="select-list" id="add-type">
                                                    @foreach(\App\Models\AnnouncementType::all() as $value)
                                                        <li class="select-list-item"
                                                            data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" id="announcement-type" required
                                                       name="announcement-type">
                                            </div>
                                            <p id="announcement-type-error" style="position: absolute;"
                                               class="ads-error-text">Please fill out this</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="property-type-container-value" id="property">

                                    <div class="ad-input-row">
                                        <div class="ad-input-row-item" id="common-area">
                                            <p class="ad-content-label">{{T("Ümumi sahə*")}}</p>
                                            <div class="input-container">
                                                <input name="area" placeholder="m²" type="number" class="input">
                                            </div>
                                        </div>
                                        <div class="ad-input-row-item" id="number-ranks">
                                            <p class="ad-content-label">{{T("Mertebe sayi*")}}</p>
                                            <div class="input-container">
                                                <input name="total-floors" placeholder="" type="number" class="input">
                                            </div>
                                        </div>
                                        <div class="ad-input-row-item" id="location-ranks">
                                            <p class="ad-content-label">{{T("Yerlesdiyi mertebe*")}}</p>
                                            <div class="input-container">
                                                <input name="current-floor" placeholder="" type="number" class="input">
                                            </div>
                                        </div>
                                        <div class="ad-input-row-item" style="display: none" id="plot-land">
                                            <p class="ad-content-label">{{T("Torpaq sahəsi*")}}</p>
                                            <div class="input-container">
                                                <input name="landArea" placeholder="Sot" type="text" type="text"
                                                       class="input">
                                            </div>
                                        </div>
                                        {{--                                        <div class="ad-input-row-item" id="number-rooms">--}}
                                        {{--                                            <p class="ad-content-label">Qonaq otaq sayı*</p>--}}
                                        {{--                                            <div class="input-container">--}}
                                        {{--                                                <input name="guestroom-count" placeholder="" type="number" class="input">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="ad-input-row-item" id="number-rooms2">--}}
                                        {{--                                            <p class="ad-content-label">Yataq otaq sayı*</p>--}}
                                        {{--                                            <div class="input-container">--}}
                                        {{--                                                <input name="bedroom-count" placeholder="" type="number" class="input">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        <div class="ad-input-row-item" id="sanitary-junction">
                                            <p class="ad-content-label">{{T("Sanitar qovşaq*")}}</p>
                                            <div class="input-container">
                                                <input name="sanitar-count" placeholder="" type="number" class="input">
                                            </div>
                                        </div>
                                        <div class="ad-input-row-item" id="total-room-count">
                                            <p class="ad-content-label">{{T("Ümumi otaq sayı*")}}</p>
                                            <div class="input-container">
                                                <input name="total-room-count" placeholder="" type="number"
                                                       class="input">
                                            </div>
                                        </div>
                                        <div class="ad-input-row-item" style="display: none" id="office-type">
                                            <p class="ad-content-label">{{T("Ofice type")}}</p>
                                            <div class="input-container">
                                                <div class="custom-ad-select custom-common-select">
                                                    <div class="select-header">
                                                        <p class="select-header-text">Seç</p>
                                                        <img src="{{asset('assets/elan/down-arrow.svg')}}"
                                                             style="width: 10px;" alt="">
                                                    </div>
                                                    <ul class="select-list">
                                                        <li class="select-list-item" value="1">1</li>
                                                        <li class="select-list-item" value="2">3</li>
                                                    </ul>
                                                    <input type="hidden" name="office-type">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="ad-content-item">
                                        <p class="ad-content-label">{{T("Qeyd")}}</p>
                                        <div class="ad-content-value ad-content-value-full">
                                            <div class="textarea-container">
                                                <p class="input-label">{{T("Əlavə qeydlər")}}</p>
                                                <textarea name="description" placeholder="Ətraflı məlumat"
                                                          class="textarea"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="ad-section">
                            <div class="ad-content-container">
                                <div class="ad-content-item">
                                    <p class="ad-content-label">{{T("Qiymət*")}}</p>
                                    <div class="ad-content-value ad-content-value-price">

                                        <div class="input-container">
                                            <div class="prefix-container">
                                                <input name="price"
                                                       placeholder="Qiymət"
                                                       type="number"
                                                       required
                                                       class="phone-input">
                                                <div class="custom-ad-select custom-common-select currency-select">
                                                    <div class="select-header lang-select-header">
                                                        <p class="select-header-text">AZN</p>
                                                        <img src="{{asset('assets/elan/down-arrow.svg')}}"
                                                             style="width: 10px;" alt="">
                                                    </div>
                                                    <ul class="select-list">
                                                        @foreach(\App\Models\CurrencyType::all() as $value)
                                                            <li class="select-list-item"
                                                                data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <input type="hidden" name="currency"
                                                           value="{{\App\Models\CurrencyType::all()[0]['_id']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="add-type-triggered checkbox-container-wrapper" style="padding: 0;">
                                            <label class="checkbox-container">
                                                <input type="checkbox" class="checkbox has-order">
                                                <span class="checkbox-mask"></span>
                                                <span class="checkbox-label">{{T("Kupça var")}}</span>
                                            </label>
                                            <label class="checkbox-container">
                                                <input type="checkbox" class="checkbox has-ipotech">
                                                <span class="checkbox-mask"></span>
                                                <span class="checkbox-label">{{T("İpoteka var")}}</span>
                                            </label>
                                        </div>

                                        {{--                                        <div class="add-type-triggered custom-ad-select custom-common-select monthly-select">--}}
                                        {{--                                            <div class="select-header">--}}
                                        {{--                                                <p class="select-header-text">Aylıq</p>--}}
                                        {{--                                                <img src="{{asset('assets/elan/down-arrow.svg')}}" style="width: 10px;"--}}
                                        {{--                                                     alt="">--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <ul class="select-list">--}}
                                        {{--                                                <li class="select-list-item" value="1">123</li>--}}
                                        {{--                                                <li class="select-list-item" value="2">123</li>--}}
                                        {{--                                                <li class="select-list-item" value="3">123</li>--}}
                                        {{--                                            </ul>--}}
                                        {{--                                        </div>--}}

                                    </div>
                                </div>

                            </div>
                            <div class="ad-content-container">
                                <div class="ad-content-item" style="grid-row-gap: 10px;">
                                    <p class="ad-content-label">{{T("Şəhər*")}}</p>
                                    <div class="ad-content-value ad-content-value-full">
                                        <div class="custom-ad-select custom-common-select">
                                            <div class="select-header">
                                                <p class="select-header-text">{{T("Şəhər")}}</p>
                                                <img src="{{asset('assets/elan/down-arrow.svg')}}" style="width: 10px;"
                                                     alt="">
                                            </div>
                                            <ul class="select-list">
                                                @foreach(\App\Models\City::all() as $value)
                                                    <li class="select-list-item"
                                                        data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="city" name="city" required>
                                        </div>

                                    </div>
                                    <p id="city-error" style="grid-column: 2/-1" class="ads-error-text">Please fill out
                                        this</p>
                                </div>

                            </div>
                            <div class="ad-content-container">
                                <div class="ad-content-item" style="grid-row-gap: 10px;">
                                    <p class="ad-content-label">{{T("Rayon*")}}</p>
                                    <div class="ad-content-value ad-content-value-full">
                                        <div class="custom-ad-select custom-common-select">
                                            <div class="select-header">
                                                <p class="select-header-text">{{T("Rayon seçin")}}</p>
                                                <img src="{{asset('assets/elan/down-arrow.svg')}}" style="width: 10px;"
                                                     alt="">
                                            </div>
                                            <ul class="select-list">
                                                @foreach(\App\Models\Provience::all() as $value)
                                                    <li class="select-list-item"
                                                        data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="provience" name="provience">
                                        </div>
                                    </div>
                                    <p id="provience-error" style="grid-column: 2/-1" class="ads-error-text">Please fill
                                        out this</p>
                                </div>

                            </div>
                            <div class="ad-content-container">
                                <div class="ad-content-item">
                                    <p class="ad-content-label">{{T("Qəsəbə")}}</p>
                                    <div class="ad-content-value ad-content-value-full">
                                        <div class="custom-ad-select custom-common-select">
                                            <div class="select-header">
                                                <p class="select-header-text">{{T("Qəsəbə seçin")}}</p>
                                                <img src="{{asset('assets/elan/down-arrow.svg')}}" style="width: 10px;"
                                                     alt="">
                                            </div>
                                            <ul class="select-list">
                                                @foreach(\App\Models\Village::all() as $value)
                                                    <li class="select-list-item"
                                                        data-value="{{$value['_id']}}">{{$value['data']['title'][Session::get('language')] ?? ''}}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="village">
                                        </div>

                                        {{--                                        <button class="choose-from-map-btn">Xəritədən seçmək</button>--}}

                                    </div>
                                </div>

                            </div>
                            <div class="ad-content-container">
                                <div class="ad-content-item">
                                    <p class="ad-content-label"></p>
                                    <div style="width: 100%; height: 300px;" id="map"
                                         mapClick="addMarker(this)"
                                         class="ad-content-value ad-content-value-full">
                                    </div>
                                    <input id="marker-position-lat" type="hidden" name="map-lat">
                                    <input id="marker-position-lng" type="hidden" name="map-lng">
                                </div>
                            </div>
                            <div class="ad-content-container">
                                <div class="ad-content-item">
                                    <p class="ad-content-label">{{T("Tam ünvan*")}}</p>
                                    <div class="ad-content-value ad-content-value-full">
                                        <div class="input-container">
                                            <input name="address" required placeholder="Küçə, evin nömrəsi və.s"
                                                   type="text"
                                                   class="input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ad-section">
                            <div class="ad-content-container">
                                <div class="ad-content-item ad-content-item-media">
                                    <div class="">
                                        <button type="button" data-value="photo" class="add-media-btn active">
                                            {{T("Şəkillər")}}
                                        </button>
                                        <button type="button" data-value="plan" class="add-media-btn">
                                            {{T("Mənzil planı")}}
                                        </button>
                                    </div>
                                    <div class="ad-content-value ad-content-value-full">

                                        <div class="ad-content-value-item" id="photo">
                                            <label class="add-photo">
                                                <input class="add-photo-input gallery-photo-add" id="gallery-photo-add"
                                                       data-type="images"
                                                       multiple
                                                       type="file">
                                                <div class="gallery gallery-photo"></div>
                                                <span class="add-photo-mask">{{T("+ Əlavə et")}}</span>
                                            </label>
                                        </div>


                                        <div style="display: none" class="ad-content-value-item" id="plan">
                                            <label class="add-photo">
                                                <input class="add-photo-input gallery-photo-add" id="gallery-photo-add"
                                                       data-type="blueprint"
                                                       multiple
                                                       type="file">
                                                <div class="gallery gallery-plan"></div>
                                                <span class="add-photo-mask">{{T("+ Əlavə et")}}</span>
                                            </label>
                                        </div>
                                        <p id="gallery-error" class="ads-error-text">Please fill out this</p>

                                        <ul class="add-media-note-list">
                                            <li class="add-media-note-item">
                                                {{T("- Şəkillərin minimal sayı — 4 ədəd")}}
                                            </li>
                                            <li class="add-media-note-item">
                                                {{T("- Binanın birinci mərtəbədən başlamaqla tam şəklinin olması mütləqdir")}}
                                            </li>
                                            <li class="add-media-note-item">
                                                {{T("- Şəkillərin optimal ölçüləri — 800 x 600 pikseldir")}}
                                            </li>
                                        </ul>

                                        <div class="confirm-label-wrapper">
                                            <label class="checkbox-container">
                                                <input type="checkbox" id="agree-checkbox" class="checkbox">
                                                <span class="checkbox-mask"></span>
                                                <span class="checkbox-label confirm-label-text">
                                                <a href="https://hesab.az/#/" class="confirm-label-link"
                                                   target="_blank">{{T("İstifadəçi qaydalarını")}}
                                                </a>
                                                    {{T("oxudum və qəbul edirəm")}}
                                                </span>
                                            </label>
                                        </div>

                                        <p id="agree-checkbox-error" class="ads-error-text" style="margin-top: -20px;">Please fill out this</p>




                                        <button type="submit" id="ad-submit-btn" class="submit-btn">
                                            {{T("Yerləşdirmək")}}
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>

                <div class="success-send-container" style="display: none">
                    <img src="./assets/images/success-send.svg" alt="" class="success-send-img">
                    <p class="success-send-title">{{T("Göndərildi")}}</p>
                    <p class="success-send-text success-send-text-main">
                        {{T(" Sizin elanınız yoxlamaya göndərildi. Əgər elan, bütün qaydalara uyğun olarsa, bir iş saatı
                         ərzində sayta yerləşdiriləcək.")}}
                    </p>
                    {{--                    <p class="success-send-text success-send-text-note">--}}
                    {{--                        Elanınızın nömrəsini itirməyin!--}}
                    {{--                    </p>--}}
                </div>

            </div>
        </div>
    </main>
    <script src="{{asset('assets/elan/script.js')}}"></script>
    <script src="{{asset('assets/place-ads/place-add.js')}}"></script>
    <script>
        $('ul.select-list').find('li').click(function () {
            const val = $(this).data('value');
            $(this).parent('ul').next('input').val(val);
        });
    </script>
    <script>
        function setHomeNumberValueToHidden() {
            setTimeout(() => {
                let number = $('#place-ads-phone-input-1').val();
                number = number.replace(/\-/g, '');
                number = number.replace("(", '');
                number = number.replace(")", '');
                $('#place-ads-phone-input-1-hidden').val(+number);
            }, 5)
        }

        var element = document.getElementById('place-ads-phone-input-1');
        var maskOptions = {
            mask: '(00)-000-00-00',
        };
        var mask = IMask(element, maskOptions);


        //second hidden phone field
        function setHomeNumberValueToHiddenSecond() {
            setTimeout(() => {
                let number = $('#place-ads-phone-input-2').val();
                number = number.replace(/\-/g, '');
                number = number.replace("(", '');
                number = number.replace(")", '');
                console.log(number)
                $('#place-ads-phone-input-2-hidden').val(+number);
            }, 5)
        }

        var element2 = document.getElementById('place-ads-phone-input-2');
        var maskOptions2 = {
            mask: '(00)-000-00-00',
        };
        var mask2 = IMask(element2, maskOptions2);


    </script>



@endsection
