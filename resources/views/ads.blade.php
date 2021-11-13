@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/ads/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section class="ads-section">
                <div>
                    <div id="left-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>

                <div class="ads-container">
                    <div>
                        <div class="ads-title">
                            <h3>{{T("Reklam yerləşdir")}}</h3>
                        </div>

                        <div class="ads-content">
                            <p class="ads-header">Saytda REKLAM yerləşdirmək</p>
                            <p>Evin.az  Azərbaycanın daşınmaz əmlak sahəsində yeni xidmətlər təklif edən onlayn platformadır. Sayt böyük müştəri bazasını əhatə edir və daşınmaz əmlak üzrə bütün sahələrdə şaxələnməyə davam edir.</p>
                            <p>Evin.az saytında reklam yerləşdirərək, hədəf müştəri kütlənizə məhsulunuzu təqdim edə, məhsuldar müştəri bazası əldə edə bilərsiniz. Evin.az ilə əməkdaşlıq etdiyiniz zaman nəinki yalnız platforma üzərindən həmçinin digər satış kanalları üzərindən də məhsulunuzun təqdimatı aparılacaqdır.</p>
                            <p>Bizimlə əməkdaşlıq etmək üçün müraciət edin!</p>
                            <p>(050) 999-99-99</p>
                            <p>(012) 999-99-99</p>
                            <p>info@evin.az</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="right-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>
            </section>
        </article>
    </main>
@endsection
