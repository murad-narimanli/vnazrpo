@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/recording/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section class="recording-section">
                <div class="recording-container">
                    <div class="recording-title">
                        <h3>{{@FallBackLanguage($content['data']['title'])}}</h3>
                    </div>

                    <div class="recording-content">
                        <div>
                            <div>
                                <p>{!! FallBackLanguage($content['data']['description']) !!}</p>
                            </div>
                            <div>
                                <figure class="recording-image">
                                    <img
                                        src="http://evinaznew.cms.kube.tisserv.net/upload/{{$content['data']['photos'][0]['path']}}"
                                        alt="">
                                </figure>
                            </div>
                            <div>
                                <p>{!! FallBackLanguage($content['data']['description2']) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="right-hand-advertisement">
                            <img
                                src="http://evinaznew.cms.kube.tisserv.net/upload/{{$content['data']['photos'][1]['path']}}"
                                alt="">
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>
@endsection
