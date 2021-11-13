@extends('profile/layout')

@section('profileContent')
    <div class="profile-data-container profile-data-container-add" id="profile-data-container-add">

        <div class="profile-data-container-add-header">

            <a href="/{{app()->getLocale()}}/profile/announcements">
                <button type="button"
                        class="profile-data-add-btn {{ Request::segment(3)=="announcements" && Request::segment(4)==null ? "active" : null }}">{{T("Aktiv elanlar")}}
                    (<span>{{ $activeCount }}</span>)
                </button>
            </a>
            <a href="/{{app()->getLocale()}}/profile/announcements/PENDING">
                <button type="button"
                        class="profile-data-add-btn {{ Request::segment(4)=="PENDING" ? "active" : null }}">{{T("Təsdiq gözləyən")}}
                    (<span>{{ $pendingCount }}</span>)
                </button>
            </a>
            <a href="/{{app()->getLocale()}}/profile/announcements/EXPIRED">
                <button type="button" data-value="expired"
                        class="profile-data-add-btn {{ Request::segment(4)=="EXPIRED" ? "active" : null }}">{{T("Vaxtı bitmiş")}}
                    (<span>{{ $expiredCount }}</span>)
                </button>
            </a>
            <a href="/{{app()->getLocale()}}/profile/announcements/REJECTED">
                <button type="button" data-value="rejected"
                        class="profile-data-add-btn {{ Request::segment(4)=="REJECTED" ? "active" : null }}">{{T("Qəbul olunmamış")}}
                    (<span>{{ $rejectedCount }}</span>)
                </button>
            </a>
        </div>
        <div class="profile-data-ad-row desktop">
            @foreach($announcements as $announcement)
                <div
                    data-id="{{$announcement['_id']}}"
                    data-link="{{langUrlPrefix()}}/object/"
                    class="profile-data-ad-container">
                    @if($announcement['data']['status'] === 'ACTIVE')
                        <div class="profile-data-ad-header">
                            <button type="button" data-type="promote"
                                    class="profile-data-ad-header-btn rice-up-profile-btn"
                                    data-id="{{$announcement['_id']}}">
                                <img src="/assets/images/top.svg" alt="">
                                {{T("İrəli çək")}}
                            </button>
                            <button type="button" data-type="vip" class="profile-data-ad-header-btn rice-up-profile-btn"
                                    data-id="{{$announcement['_id']}}"
                                    id="vip-profile-btn">
                                <img src="/assets/images/vip.svg" alt="">
                                {{T("VİP")}}
                            </button>
                        </div>
                    @endif
                    <div class="profile-data-ad-img-container">
                        <img
                            src="{{"http://evinaznew.cms.kube.tisserv.net/upload/".($announcement['data']['images'][0]['path'] ?? '')}}"
                            alt=""
                            class="profile-data-ad-img">
                    </div>
                    <div class="profile-data-ad-data-container">
                        <p class="profile-data-ad-address">
                            @if(isset($announcement['data']['metro']))
                                {{FallBackLanguage(getMetroName(@$announcement['data']['metro'])['data']['title'])}}
                            @elseif(isset($announcement['data']['marker']))
                                {{@FallBackLanguage(getMarkerName(@$announcement['data']['marker'])['data']['title'])}}
                            @else
                                {{FallBackLanguage(@getProvienceName(@$announcement['data']['provience'])['data']['title'])}}
                            @endif
                        </p>
                        <div class="profile-data-ad-data-wrapper">

                            <div class="profile-data-ad-data">
                                <div class="profile-data-ad-data-item">
                                    <img src="/assets/images/room.svg" alt="">
                                    <p>{{(@$announcement['data']['bedroom-count'] ?? 0)}}</p>
                                </div>
                                <div class="profile-data-ad-data-item">
                                    <img src="/assets/images/area.svg" alt="">
                                    <p>{{@$announcement['data']['area'] ?? ''}}&#13217;</p>
                                </div>
                                <div class="profile-data-ad-data-item">
                                    <img src="/assets/images/shower.svg" alt="">
                                    <p>{{(@$announcement['data']['guestroom-count'] ?? 0)}}</p>
                                </div>
                                <div class="profile-data-ad-data-item">
                                    <img src="{{"/assets/images/rank.svg"}}" alt="">
                                    <p>
                                        <span>{{@$announcement['data']['current-floor'] ?? 1}}</span>/
                                        <span>{{@$announcement['data']['total-floors']}}</span>
                                    </p>
                                </div>
                            </div>
                            <p class="profile-data-ad-date">{{@FallBackLanguage(getCityName($announcement['data']['city'])['data']['title'] ?? '')}}
                                , {{date('d.m.Y', strtotime($announcement['data']['create-date'] ?? ''))}}</p>
                        </div>
                    </div>
                    <div class="profile-data-ad-footer">
                        <p class="profile-data-ad-amount">{{@$announcement['data']['price'] ?? ''}} AZN</p>
                        <div class="profile-data-ad-footer-btn-container">
                            <button class="profile-data-ad-footer-btn">
                                <img src="" alt="">
                            </button>
                            <button class="profile-data-ad-footer-btn">
                                <img src="" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="profile-data-ad-row mobile">
            @foreach($announcements as $announcement)
                <div
                    data-id="{{$announcement['_id']}}"
                    data-link="{{langUrlPrefix()}}/object/"
                    class="profile-data-ad-container">
                    @if($announcement['data']['status'] === 'ACTIVE')
                        <div class="profile-data-ad-header">
                            <div   class="card--header"
                                    data-id="{{$announcement['_id']}}">
                                {{T("İrəli çək")}} / {{T("VİP")}}
                            </div>
{{--                            <button type="button" data-type="vip" class="profile-data-ad-header-btn rice-up-profile-btn"--}}
{{--                                    data-id="{{$announcement['_id']}}"--}}
{{--                                    id="vip-profile-btn">--}}
{{--                                <img src="/assets/images/vip.svg" alt="">--}}
{{--                                {{T("VİP")}}--}}
{{--                            </button>--}}
                        </div>
                    @endif
                    <div class="profile-data-ad-img-container">
                        <img
                            src="{{"http://evinaznew.cms.kube.tisserv.net/upload/".($announcement['data']['images'][0]['path'] ?? '')}}"
                            alt=""
                            class="profile-data-ad-img">
                    </div>
                        <div class="profile-data-ad-data-container profile-data-ad-footer">
                            <p class="profile-data-ad-amount">{{@$announcement['data']['price'] ?? ''}} AZN</p>
                            <p class="profile-data-ad-date">{{date('d.m.Y', strtotime($announcement['data']['create-date'] ?? ''))}}</p>
                            <div class="profile-data-ad-footer-btn-container">
                                <button class="profile-data-ad-footer-btn">
                                    <img src="" alt="">
                                </button>
                                <button class="profile-data-ad-footer-btn">
                                    <img src="" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="custom--hr"></div>
                        <div class="profile-data-ad-data-container">
                        <p class="profile-data-ad-address">
                            @if(isset($announcement['data']['metro']))
                                {{FallBackLanguage(getMetroName(@$announcement['data']['metro'])['data']['title'])}}
                            @elseif(isset($announcement['data']['marker']))
                                {{@FallBackLanguage(getMarkerName(@$announcement['data']['marker'])['data']['title'])}}
                            @else
                                {{FallBackLanguage(@getProvienceName(@$announcement['data']['provience'])['data']['title'])}}
                            @endif
                        </p>
                        <div class="profile-data-ad-data-wrapper">
                            <div class="profile-data-ad-data">
                                <div class="profile-data-ad-data-item">
                                    <p class="custom__before-dot">{{(@$announcement['data']['bedroom-count'] ?? 0)}}</p>
                                </div>
                                <div class="profile-data-ad-data-item">
                                    <p class="custom__before-dot">{{$announcement['data']['area'] ?? ''}}&#13217;</p>
                                </div>
                                <div class="profile-data-ad-data-item">
                                    <p class="custom__before-dot">
                                        <span>{{@$announcement['data']['current-floor'] ?? 1}}</span>/
                                        <span>{{@$announcement['data']['total-floors']}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$announcements->links()}}
    </div>
@endsection
