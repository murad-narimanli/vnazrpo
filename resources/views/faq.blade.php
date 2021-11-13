@extends('index')
@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale());
@endphp
@section('header')
    <link rel="stylesheet" href="{{asset('assets/faq/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/faq/mobile.css?cssv=4')}}">
    <style>
        .faq-section .faq-container .faq-content .faq-card .faq-header .fa-minus
        {
            visibility: visible;
        }
    </style>
@endsection

@section('content')
    <main>
        <article>
            <section class="faq-section">
                <div>
                    <div id="left-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>

                <div class='faq-container'>
                    <div class="faq-title faq-title-mobile">
                        <h3>{{T("Tez-tez soruşulan suallar")}}</h3>
                    </div>

                    <div class="faq-content">
                        @foreach(\App\Models\FAQ::all() as $value)
                            <div class="faq-card">
                                <div class="faq-header">
                                    <div><p class="faq-header-question">{!! $value['data']['question'][\Illuminate\Support\Facades\App::getLocale()] ?? '' !!}</p></div>
                                    <div style="display: none"><i class="fas fa-minus"></i></div>
                                    <div style="display: block"><i class="fas fa-plus"></i></div>
                                </div>

                                <div class="faq-text" style="display: none">
                                    <p class="faq-paragraph">{!! $value['data']['answer'][\Illuminate\Support\Facades\App::getLocale()] ?? '' !!}</p>
                                </div>
                            </div>
                        @endforeach
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
    <script>
        $(document).ready(function() {
            $('.fas.fa-minus').click(function () {
                $(this).parent().hide();
                $(this).parent().next('div').show();
                $(this).parents('.faq-header').next('.faq-text').slideUp(100);
            });
            $('.fas.fa-plus').click(function () {
                $(this).parent().hide();
                $(this).parent().prev('div').show();
                $(this).parents('.faq-header').next('.faq-text').slideDown(100);
            });
        });
    </script>
@endsection
