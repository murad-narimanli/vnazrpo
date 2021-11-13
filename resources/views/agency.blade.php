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

                    <div class="agency-card-section">
                        <div class="agency-title">
                            <h3>{{T("Agentliklər")}}</h3>
                        </div>

                        <div class="agency-flex-cards agency-flex-cards-mobile container">
                            @foreach($agency as $value)
                                <div class="agency-card col-xs-12 mobile__card"
                                     onclick="location.href='{{langUrlPrefix()}}/agency/{{$value['_id']}}'">
                                    @if(isset($value['data']['fullname']) && $value['data']['fullname'] != null)
                                        <h4>{{$value['data']['fullname']}}</h4>
                                    @endif
                                    @if(isset($value['data']['phone-number']) && $value['data']['phone-number'] != null)
                                        <p class="agency-phone paragraphs">{{$value['data']['phone-number']}}</p>
                                    @endif
                                    @if(isset($value['data']['adress']) && $value['data']['adress'] !=null)
                                        <p class="agency-adress paragraphs" id="paragraphs">{{$value['data']['adress']}}</p>
                                    @endif
                                        <button class="request-btn mobile__request-box">{{\App\Models\Announcement::where('data.status', 'ACTIVE')->where('data.merchant', $value['_id'])->count()}}
                                            {{T("Təklif")}}
                                        </button>
                                </div>
                            @endforeach
                        </div>
                        {{ $agency->links() }}
                    </div>
                </div>
            </section>
        </article>
    </main>
@endsection
