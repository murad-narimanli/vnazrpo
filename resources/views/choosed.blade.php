@extends('index')

@section('header')
 <link rel="stylesheet" href="{{asset('assets/agency-detail/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/last/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/home/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/home/custom.css?cssv=4')}}">
@endsection

@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale())
@endphp
@section('content')
    <main>
        <article>
            <section class="chosen_section container">
                <div class="chosen_section_title">
                    <h1>{{T("Seçilmişlər")}}</h1>
                </div>
                <div class="chosen_cards_all last-section-cards-flex mb-5 container rent__flex-cards">
                    @foreach($lastest as $value)
                     <div class="last-section-card mb-4 justify-content-inithal object-container rent__object"
                         data-id="{{$value['_id']}}"
                         data-link="{{langUrlPrefix()}}/object/">
                        <div class="vip-card-header">
                            <div class="vip-card-header-data-btn-container">
                                @if(!empty($value['data']['document-type']) && $value['data']['document-type'] == '60bdf0671f35a21fd8f3d4be')
                                    <button class="vip-card-header-data-btn blue">
                                        {{T("ÇIXARIŞLI")}}
                                    </button>
                                @endif
                                @if(!empty($value['data']['ipotech-type']))
                                    <button class="vip-card-header-data-btn red">
                                        {{T("İPOTEKA VAR")}}
                                    </button>
                                @endif
                            </div>
                            @if(isset($value['data']['images']))
                                <div class="vip-card-slider custom__card-slider">
                                    <figure>
                                      <div class="card-image">
                                          <img
                                            class="w-100"
                                            src="http://evinaznew.cms.kube.tisserv.net/upload/{{$value['data']['images'][0]['path'] ?? ''}}"
                                            alt="">
                                      </div>
                                    </figure>
                                </div>
                            @endif
                        </div>
                        <div class="last-section-card-title my-2 d-sm-block d-none">
                            <h5 class="px-3"> @if(isset($value['data']['metro']))
                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                @elseif(isset($value['data']['marker']))
                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                @else
                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                @endif</h5>
                        </div>
                         <div
                            class="w-100 flex-wrap mobileCard border-bottom font-weight-bold mt-3 d-sm-none d-block px-3 d-flex justify-content-between">
                            <h4 class="price-dots">{{@$value['data']['price']}} {{@\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                            <p class="date-mob-footer">
                                @isset($value['data']['create-date']) {{date('d.m.Y', strtotime($value['data']['create-date']))}} @endisset
                            </p>
                        </div>
                       <div>
                            <h5 class="custom-card-title px-3 fa-1x font-weight-bold line-clamb line-1 mt-2 d-sm-none d-block">
                                @if(isset($value['data']['metro']))
                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                @elseif(isset($value['data']['marker']))
                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                @else
                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                @endif
                            </h5>
                        </div>
                        <div class="last-section-card-content ">
                             <div class="d-sm-flex d-none px-3">
                                 <div class="d-flex mr-3">
                                     <span class="item-hidden-icon">
                                         <img src="/assets/icons/room.svg" alt="">
                                     </span>
                                     <p class=" custom__before-dot">
                                         {{@$value['data']['total-room-count']}}
                                         {{T("otaq")}}
                                     </p>
                                 </div>
                                 <div class="d-flex">
                                     <span class="item-hidden-icon"><img
                                             src="/assets/icons/area.svg" alt=""></span>
                                     <p class=" custom__before-dot">{{$value['data']['area'] ?? ''}}
                                         &#13217;
                                     </p>
                                 </div>
                             </div>

                             <div
                                 class="d-sm-none  d-flex flex-wrap justify-content-between first-row">
                                 <div>
                                     <span class="item-hidden-icon">
                                         <img src="/assets/icons/room.svg" alt="">
                                     </span>
                                     <p class="f-12 custom__before-dot">
                                         {{@$value['data']['total-room-count']}}
                                         {{T("otaq")}}
                                     </p>
                                 </div>

                                 <div>
                                     <span class="item-hidden-icon"><img
                                             src="/assets/icons/area.svg" alt=""></span>
                                     <p class="f-12 custom__before-dot">{{$value['data']['area'] ?? ''}}
                                         &#13217;
                                     </p>
                                 </div>

                               <div class="ml-0">
                                     <span class="item-hidden-icon"><img src="/assets/icons/floor.svg" alt=""></span>
                                     <p class="f-12 custom__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                         <span>{{T("mərtəbə")}}</span>
                                     </p>
                                </div>

                             </div>

                            <div class="last-section-second-row px-3 justify-content-between custom__second-row">
                                 <div class='d-sm-flex  d-none'>
                                    <span class="item-hidden-icon">
                                        <img src="/assets/icons/floor.svg" alt="">
                                    </span>
                                    <p  class="rent__before-dot">{{$value['data']['current-floor'] ?? 1}}/{{$value['data']['total-floors'] ?? 1}}
                                        <span class="floor-span">{{T("mərtəbə")}}</span>
                                    </p>
                                </div>

                                 <div class="vip-date custom__card-date d-sm-flex d-none">
                                    <p>{{\App\Models\City::find($value['data']['city'])->data['title'][App::getLocale()] ?? ''}},
                                        @isset($value['data']['create-date']) {{date('d.m.Y', strtotime($value['data']['create-date']))}} @endisset
                                    </p>
                                </div>

                            </div>

                            <div class="last-section-third-row custom__card-footer px-3 customFooter justify-content-between rent__card-footer">
                                <h4 class="price-dots d-sm-block d-none" id="price">{{$value['data']['price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</h4>
                                <div class="stars2">
                                    <button>
                                        @if(in_array($value['_id'],$inFavoritesList))
                                            <i class="fas fa-star"
                                               onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                        @else
                                            <i class="far fa-star"
                                               onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                        @endif
                                    </button>
                                    <button>
                                        @if(in_array($value['_id'],$inCompareList))
                                            <i class="fas fa-exchange-alt"
                                               onclick="removeCompareList('{{$value['_id']}}',this)"></i>
                                        @else
                                            <i class="fal fa-exchange-alt"
                                               onclick="addCompareList('{{$value['_id']}}',this)"></i>
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </article>
    </main>
@endsection
