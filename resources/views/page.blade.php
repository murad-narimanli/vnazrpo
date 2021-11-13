@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/repair/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
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
                            <h3>{!! FallBackLanguage(@$pageContent['data']['title']) !!}</h3>
                        </div>

                        <div class="repair-content">
                            <div>
                                {!! FallBackLanguage(@$pageContent['data']['content']) !!}
                            </div>
                        </div>
                    </div>

                    @if(count($pageContent['data']['photos'] ?? []) > 0)
                        <div>
                            <div class="repair-title">
                                <h3>{{T("Görüntülər")}}</h3>
                            </div>

                            <div class="repair-projects">
                                @foreach (@$pageContent['data']['photos'] ?? [] as $value)
                                    <div class="repair-image-card">
                                        <figure>
                                            <img src="/upload/resize/300/300/{{$value['path']}}" alt="">
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
