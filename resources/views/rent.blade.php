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
            <section>
                <div class="last-ads-container container">
                    {{--                    <div class="last-ads-header">--}}
                    {{--                        <p><a href="#">Satış</a> <span>></span> </p>--}}
                    {{--                        <p><a href="#">Ev elanları</a> <span>></span> </p>--}}
                    {{--                        <p><a href="#">Son elanlar</a></p>--}}
                    {{--                    </div>--}}

                    <div>
                        <div class="last-ads-cards-section container">
                            <div class="last-ads-title">
                                <h3>{{T("Kirayə evlər")}} ({{count($objects)}})</h3>
                            </div>

                            <div class="last-ads-cards-section-selection">
                                <div class="last-ads-cards-section-buttons ">
                                <button class="last-ads-cards-section-button-list"
                                      onclick="hideSearchMap('testMap2')"><i class="fas fa-list"></i>
                                        <p>{{T("Siyahı")}}</p></button>
                                <button class="last-ads-cards-section-button-map" onclick="showMyMap('testMap2')"><i
                                      class="fas fa-map-marked-alt"></i>
                                  <p>{{T("Xəritə")}}</p></button>
                                </div>

                                <div class="last-ads-cards-section-buttons-selection  align-items-center d-flex justify-content-between">
                                       <div class="form-div custom-common-select sort px-2 w-100 align-items-center custom__form-item" id="first-div">
                                         <p>@if(isset($_GET['date'])) {{T("Tarix üzrə")}}
                                             @elseif(isset($_GET['area']))  {{T("Sahə üzrə")}}
                                             @elseif(isset($_GET['price']) && $_GET['price'] == 'asc')  {{T("Ucuzdan bahaya")}}
                                             @elseif(isset($_GET['price']) && $_GET['price'] == 'desc')  {{T("Bahadan ucuza")}}
                                             @else {{T("Tarix üzrə")}}
                                             @endif</p>
                                         <i class="fas fa-caret-down"></i>
                                         <ul class="form-div-list select-list">
                                            <li  class="form-div-item"  data-value="Tarix üzrə"><a class="text-decoration-none " href="?date=desc" >{{T("Tarix üzrə")}}</a></li>
                                            <li  class="form-div-item"  data-value="Sahə üzrə"><a class="text-decoration-none " href="?area=asc">{{T("Sahə üzrə")}}</a></li>
                                            <li  class="form-div-item" data-value="Ucuzdan bahaya"><a class="text-decoration-none " href="?price=asc" >{{T("Ucuzdan bahaya")}}</a></li>
                                            <li  class="form-div-item"  data-value="Tarix üzrə"><a class="text-decoration-none " href="?price=desc" >{{T("Bahadan ucuza")}}</a> </li>
                                         </ul>
                                          <input type="hidden" name="announcementType" >
                                       </div>
                                </div>
                            </div>
                        </div>

                        <div class="last-section-cards-flex mb-5 container ads-list ">
                            @foreach($objects as $value)
                                <div class="last-section-card mb-4   justify-content-inithal object-container rent__object"
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
                                                <button class="starButton" style="border-radius: 14px;">
                                                    @if(in_array($value['_id'],$inFavoritesList))
                                                        <i class="fas fa-star"
                                                           onclick="removeSelectedList('{{$value['_id']}}',this)"></i>
                                                    @else
                                                        <i class="far fa-star"
                                                           onclick="addSelectedList('{{$value['_id']}}',this)"></i>
                                                    @endif
                                                </button>
                                                 <button class="starButton" style="border-radius: 14px;">
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
                            {{ $objects->links() }}
                        </div>


                    {{--     <div id="rent-search-map d-none" style="margin-top: 20px; display: none">

                        </div> --}}
                            <div style='margin-bottom: 50px; opacity:0; width: 100%; height: 0px;' id="testMap2">
                                  <div id="map2" style="margin-top: 20px; width: 100%; height: 641px;"></div>
                              </div>

                    </div>
                </div>
                </div>
            </section>
        </article>
    </main>


      <input type="hidden" id="lang" value="{{langUrlPrefix()}}" >

    <script>
        $(document).ready( async function () {
            var gmarkers = [];
            var markers = [];
            let lang = $("#lang").val();
            await $.ajax({
                url: "/map/getObject",
                type: "post",
                data: {
                    "type" : "kiraye"
                },
                success: function (response) {
                     let data = response[0]
                     console.log(data)
                     data.forEach((d, index) => {
                         let newData = d.data
                         console.log(newData)
                          let obj = {
                              ...d,
                              key: index + 1 ,
                               photoPath: `https://evinaznew.cms.kube.tisserv.net/upload/crop/700/641/${newData?.images[0]?.path}` ,
                               room: newData['total-room-count'],
                               area: newData?.area,
                               price: newData?.price,
                               lat: + d.data['map-lat'],
                               lng: + d.data['map-lng']
                          };
                          if(d.data['map-lat'] && d.data['map-lng']){
                            markers.push(obj)
                          }
                      })
                 },
                error: function (error) {
                    markers = [error]
                }
            });
            console.log(markers);
            var myOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                streetViewControl: false,
            };

            var map = new google.maps.Map(document.getElementById("map2"), myOptions);

            var infowindow = new google.maps.InfoWindow();
            var marker;
            var bounds = new google.maps.LatLngBounds();
            var icons = '/assets/icons/map-mark.svg';

            markers.forEach((mark, i) => {
                var pos = new google.maps.LatLng(mark.lat, mark.lng);
                bounds.extend(pos);
                marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: icons
                });
                gmarkers.push(marker);
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(`
                          <a href=${lang + '/object/' + mark._id} class="card text-dark text-decoration-none map-card"  style="width: 250px;">
                              <div class="image-card">
                                <img style="object-fit:cover" src=${mark.photoPath} class="card-img-top" alt="...">
                                <div class="price">${mark.price} azn</div>
                              </div>
                              <div class="card-body py-2">
                                <p class="card-title mb-1 pb-1 font-weight-bold">${mark?.data?.address?.az && mark?.data?.address?.az}</h5>
                                <div class="row w-100 pb-2">
                                    <div class="col-6 d-flex align-items-center"><i class="mr-1 dots fas fa-circle"></i> ${mark.room} otaq</div>
                                    <div class="col-6 d-flex align-items-center"><i class="mr-1 dots fas fa-circle"></i> ${mark.area} m<sup>2</sup> </div>

                                </div>
                              </div>
                            </div>
                        `);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            })
            map.fitBounds(bounds);
        });
    </script>
    <script src="{{asset('assets/javascript/list-map.js')}}"></script>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer_compiled.js"
        integrity="sha512-DRb7DDx102X//EZzXafSrvSfM2vsm58IEdTpAlUAJPv27ziyWCoKL25E42yY+GJM6AEtCGzSrsQ9RPGfDnd1Cg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
