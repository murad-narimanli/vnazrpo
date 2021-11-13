@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/agency/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/agency/mobile.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section>
                <div class="agency-container container">
                    {{--                    <div class="agency-header">--}}
                    {{--                        <p><a href="#">Satış</a> <span>></span> </p>--}}
                    {{--                        <p><a href="#">Ev elanları</a> <span>></span> </p>--}}
                    {{--                        <p><a href="#">Son elanlar</a></p>--}}
                    {{--                    </div>--}}

                    <div class="agency-card-section container">
                        <div class="agency-title">
                            <h3>{{T("Makler")}}</h3>
                        </div>

                        <div class="agency-flex-cards agency-flex-cards-mobile container">
                            @foreach($makler as $value)
                                <div class="agency-card mobile__card" onclick="location.href='{{langUrlPrefix()}}/makler/{{$value['_id']}}'">
                                    <h4>{{$value['data']['fullname']}}</h4>
                                    <p class="agency-phone paragraphs">{{$value['data']['phone-number']}}</p>
                                    <p class="agency-adress paragraphs">{{$value['data']['adress']}}</p>
                                    <button class="request-btn mobile__request-box">{{\App\Models\Announcement::where('data.status', 'ACTIVE')->where('data.merchant', $value['_id'])->count()}} {{T("Təklif")}}</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>
@endsection
