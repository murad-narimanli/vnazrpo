@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/last/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/home/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/residence-detail/mobile.css?cssv=4')}}">
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
                        <div class="last-ads-cards-section">
                            <div class="last-ads-title">
                                <h3>{{T("Yaşayış kompleksləri")}} ({{count($residences)}})</h3>
                            </div>

                            <div class="last-ads-cards-section-selection">
                                  <div class="last-ads-cards-section-buttons ">
                                      <button class="last-ads-cards-section-button-list"
                                                   onclick="hideSearchMap('testMap4')"><i class="fas fa-list"></i>  <p>{{T("Siyahı")}}</p></button>
                                           <button class="last-ads-cards-section-button-map" onclick="showMyMap('testMap4')"><i  class="fas fa-map-marked-alt"></i>    <p>{{T("Xəritə")}}</p></button>
                                    </div>

                                <div class="last-ads-cards-section-buttons-selection ">
                                      <div class="form-div custom-common-select sort px-2 h-100 custom__form-item" id="first-div">
                                         <p>@if(isset($_GET['date'])) {{T("Tarix üzrə")}}
                                             @elseif(isset($_GET['area']))  {{T("Sahə üzrə")}}
                                             @elseif(isset($_GET['price']) && $_GET['price'] == 'asc')  {{T("Ucuzdan bahaya")}}
                                             @elseif(isset($_GET['price']) && $_GET['price'] == 'desc')  {{T("Bahadan ucuza")}}
                                             @else {{T("Tarix üzrə")}}
                                             @endif</p>
                                         <i class="fas fa-caret-down"></i>
                                         <ul class="form-div-list select-list">
                                            <li  class="form-div-item"  data-value="Tarix üzrə"><a class="text-decoration-none" href="?date=desc" >{{T("Tarix üzrə")}}</a></li>
                                            <li  class="form-div-item"  data-value="Sahə üzrə"><a class="text-decoration-none " href="?area=asc">{{T("Sahə üzrə")}}</a></li>
                                            <li  class="form-div-item" data-value="Ucuzdan bahaya"><a class="text-decoration-none " href="?price=asc" >{{T("Ucuzdan bahaya")}}</a></li>
                                            <li  class="form-div-item"  data-value="Tarix üzrə"><a class="text-decoration-none " href="?price=desc" >{{T("Bahadan ucuza")}}</a> </li>
                                         </ul>
                                          <input type="hidden" name="announcementType" >
                                       </div>
                            </div>
                        </div>
                        </div>

                        <div>
                            <div class="complex-section">

                            <div class="ads-list">
                                <div class='complex-flex-cards    residence-mobile-card'>
                                    @foreach($residences as $value)
                                        <div class="complex-card" onclick="location.href='{{langUrlPrefix()}}/residence/{{$value['_id']}}'">
                                            <figure>
                                               <div class="complex-card-image">
                                                 <img src="http://evinaznew.cms.kube.tisserv.net/upload/{{@$value['data']['images'][0]['path']}}" alt="">
                                                   <div class="complex-card-price full" id="custom__card_price">
                                                        <h5 class="price-dots">{{$value['data']['start-price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}-dən</h5>
                                                  </div>
                                               </div>


                                            </figure>

                                            <div class="complex-card-title">
                                                <h5>{{$value['data']['adress']}}</h5>
                                            </div>

                                            <div class="card-list">
                                                <ul>
                                                    <li> <img class="icons" src="{{url('/assets/icons/construction.svg')}}"/> {{$value['data']['fullname']}}</li>
                                                    @if($value['data']['metro'] ?? false)
                                                        <li> <img class="icons" src="{{url('/assets/icons/train.svg')}}"/>{{\App\Models\Metro::find($value['data']['metro'])->data['title'][App::getLocale()] ?? ''}}</li>
                                                    @endif
                                                    @if($value['data']['marker'] ?? false)
                                                        <li> <img class="icons" src="{{url('/assets/icons/place-mark.svg')}}"/>{{\App\Models\Marker::find($value['data']['marker'])->data['title'][App::getLocale()] ?? ''}}</li>
                                                    @endif
                                                    @if($value['data']['is-finished'])
                                                        <li> <img class="icons" src="{{url('/assets/icons/key.svg')}}"/>{{T("Təhvil verilib")}}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                        {{ $residences->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                     {{--   <div id="residence-search-map"></div> --}}

                      <div style='margin-bottom: 50px; opacity:0; width: 100%; height: 0px;' id="testMap4">
                                                 <div id="map" style="margin-top: 20px; width: 100%; height: 641px;"></div>
                                             </div>

                        {{--                        <div class="last-ads-section-card-pages-flex">--}}
                        {{--                            <div class="last-ads-section-card-pages">--}}

                        {{--                                <button><i class="fas fa-chevron-left"></i></button>--}}

                        {{--                                <div class="last-ads-section-card-pages-left">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li>1</li>--}}
                        {{--                                        <li>2</li>--}}
                        {{--                                        <li>...</li>--}}
                        {{--                                        <li>14</li>--}}
                        {{--                                        <li>15</li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div class="last-ads-section-card-pages-right">--}}

                        {{--                                <button><i class="fas fa-chevron-right"></i></button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

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
                            "type" : location.pathname.includes("vip") ?  "vip" : "son"
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

                    var map = new google.maps.Map(document.getElementById("map"), myOptions);

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
                                        <p class="card-title mb-1 pb-1 font-weight-bold">${mark?.data?.address?.az && mark?.data?.address?.az}</p>
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
