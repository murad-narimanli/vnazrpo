@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/about/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section class="about-section">
                <div>
                    <div id="left-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>

                <div class="about-container">
                    <div>
                        <div class="about-title">
{{--                            <h3>{{$page}}</h3>--}}
                            <h3>{{$page['data']['title'][app()->getLocale()]}}</h3>
                        </div>

                        <div class="about-content">
                            {!! $page['data']['content'][app()->getLocale()] !!}
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
