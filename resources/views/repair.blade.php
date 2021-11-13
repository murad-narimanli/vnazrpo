@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/repair/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection
@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale())
@endphp

@section('content')
    <main>
        <article>
            <section class="repair-section">
                <div>
                    <div id="left-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>

                <div class="repair-container">
                    <div>
                        <div class="repair-title">
                            <h3>{{T("Mənzil təmiri")}}</h3>
                        </div>

                        <div class="repair-content">
                            <div>
                                {{$portfolio['description'][App::getLocale()]}}
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="repair-title">
                            <h3>{{@FallBackLanguage($portfolio['title'])}}</h3>
                        </div>

                        <div class="repair-projects">
                            @foreach ($portfolio['portfolio'] ?? [] as $value)
                            <div class="repair-image-card">
                                <figure>
                                    <img src="/upload/resize/300/300/{{$value['path']}}" alt="">
                                </figure>
                            </div>
                            @endforeach
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
