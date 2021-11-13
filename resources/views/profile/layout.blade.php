@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/profile/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endsection

@section('content')
    <br>
    <main>
        <div class="container">
            <div class="profile-content">
                <div class="profile-nav-content">
                    <ul class="profile-nav-list">
                        <li onclick="location.href = '/{{app()->getLocale()}}/profile/announcements'" value="ad"
                            class="profile-nav-item {{$activeTab == 'announcements'? 'active' : '' }}">
                            {{T("Elanlarım")}}
                        </li>
                        <li onclick="location.href = '/{{app()->getLocale()}}/profile/balance'" value="balance"
                            class="profile-nav-item  {{$activeTab == 'balance'? 'active' : '' }}">
                            {{T("Balansım")}}
                        </li>
                        <li onclick="location.href = '/{{app()->getLocale()}}/profile/payments'" value="invoice"
                            class="profile-nav-item  {{$activeTab == 'payments'? 'active' : '' }}">
                            {{T("Ödənişlərim")}}
                        </li>
                        <li onclick="location.href = '/{{app()->getLocale()}}/profile/orders'" value="invoice"
                            class="profile-nav-item  {{$activeTab == 'orders'? 'active' : '' }}">
                            {{T("Hesab fakturalar")}}
                        </li>
                        <li onclick="location.href = '/{{app()->getLocale()}}/profile/profile'" value="profile"
                            class="profile-nav-item  {{$activeTab == 'profile'? 'active' : '' }}">
                            {{T("Profil")}}
                        </li>
                    </ul>
                    {{-- <div class="apartment-order-container"> --}}
                      {{--  <div class="apartment-order-main">--}}
                           {{-- <p class="apartment-order-text">{{T("Məznil sifarişi")}}</p>--}}
                           {{-- <label class="apartment-order-toggle-wrapper">--}}
                               {{-- <input type="checkbox" class="apartment-order-checkbox">--}}
                               {{-- <span class="apartment-order-toggle">--}}
                               {{-- <span class="checkbox-mask"></span>--}}
                          {{--  </span>--}}
                           {{-- </label>--}}
                       {{-- </div>--}}
                       {{-- <p class="apartment-order-note">--}}
                          {{--  {{T("Sizin istəklərinizə uyğun ev tövsiyyələri edilir.")}}--}}
                       {{-- </p>--}}
                    {{--</div>--}}
                </div>
                @yield('profileContent')
            </div>
        </div>
    </main>


    <div class="popup-up-wrapper" style="display: none;" id="rice-up-profile-popup">
        <div class="profile-popup">
            <div class="profile-popup-header">
                <p class="profile-popup-title">
                    <i class="fas fa-long-arrow-alt-up"></i>
                    {{T("İrəli çək")}}
                </p>
                <button class="profile-popup-close-btn" id="rise-popup-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="profile-popup-content">
                <p class="profile-popup-text">{{T("Elanınız yeni elanlar bölməsində və axtarış nəticələrində irəli
                    çəkiləcəkdir.")}}</p>
                <ul class="profile-popup-list">
                    <li class="profile-popup-list-item" onclick="selectAmount(300)">
                        <label class="profile-popup-label">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">1 dəfə / 3,00 AZN</span>
                        </label>
                    </li>
                    <li class="profile-popup-list-item" onclick="selectAmount(600)">
                        <label class="profile-popup-label">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">3 dəfə (hər 24 saat) / 6,00 AZN</span>
                        </label>
                    </li>
                    <li class="profile-popup-list-item" onclick="selectAmount(900)">
                        <label class="profile-popup-label">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">5 dəfə (hər 24 saat) / 9,00 AZN</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="profile-popup-content">
                <ul class="profile-popup-list">
                    <li class="profile-popup-list-item">
                        <label class="profile-popup-label">
                            <input name="payment-type" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">Şəxsi pul kisəsi (0,00 AZN)</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="profile-popup-content">
                <button class="profile-popup-pay-btn" onclick="doVip()">Ödə</button>
                <p class="profile-popup-pay-note">
                    «Ödə» düyməsini sıxmaqla siz, Evin.az-ın
                    <a href="">İstifadəçi razılaşmasını</a>
                    və
                    <a href=""> Qaydalarını</a>
                    qəbul etmiş olursunuz
                </p>
            </div>
        </div>
    </div>

    <div class="popup-up-wrapper" style="display: none;" id="vip-profile-popup">
        <div class="profile-popup">
            <div class="profile-popup-header">
                <p class="profile-popup-title">
                    <img src="/assets/images/vip.svg" alt="">
                    VIP et
                </p>
                <button class="profile-popup-close-btn" id="vip-popup-close"><i class="fas fa-times"></i></button>
            </div>
            <div class="profile-popup-content">
                <p class="profile-popup-text">Elanınız yeni elanlar bölməsində və axtarış nəticələrində irəli
                    çəkiləcəkdir.</p>
                <ul class="profile-popup-list profile-popup-vip-list">
                    <li class="profile-popup-list-item">
                        <label class="profile-popup-label" data-price="100">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">1 gün / 1,00 AZN</span>
                        </label>
                    </li>
                    <li class="profile-popup-list-item">
                        <label class="profile-popup-label" data-price="300">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">3 gün (hər 24 saat) / 3,00 AZN</span>
                        </label>
                    </li>
                    <li class="profile-popup-list-item">
                        <label class="profile-popup-label" data-price="500">
                            <input name="time-range" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">5 gün (hər 24 saat) / 5,00 AZN</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="profile-popup-content">
                <ul class="profile-popup-list">
                    <li class="profile-popup-list-item">
                        <label class="profile-popup-label">
                            <input name="payment-type" type="radio" class="profile-popup-radio">
                            <span class="profile-popup-input-mask"></span>
                            <span class="profile-popup-label-text">Şəxsi pul kisəsi ({{$userBalance ?? 0}} AZN)</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="profile-popup-content">
                <button class="profile-popup-pay-btn" onclick="doVip()">Ödə</button>
                <p class="profile-popup-pay-note">
                    «Ödə» düyməsini sıxmaqla siz, Evin.az-ın
                    <a href="">İstifadəçi razılaşmasını</a>
                    və
                    <a href=""> Qaydalarını</a>
                    qəbul etmiş olursunuz
                </p>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/profile/backend.js')}}"></script>
    <script src="{{asset('assets/profile/script.js')}}"></script>
    <script type="text/javascript">
        $('.balance-increases-btn').click(function () {
            var price = $('.balance-increases-input').val();
            $.post('/add-balance', {price: price, _token: '{{csrf_token()}}'}, function (data) {
                try {
                    var result = JSON.parse(data);
                } catch (e) {
                    return false;
                }
                if (result.status == 200) {
                    window.open(
                        result.redirectUrl,
                        '_blank' // <- This is what makes it open in a new window.
                    );
                } else {
                    alert('Xəta baş verdi!');
                }
            });
        });
    </script>
@endsection
