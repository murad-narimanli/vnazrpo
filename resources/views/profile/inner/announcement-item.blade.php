<div
    data-id="id"
    data-link="/object/{{$announcement['_id']}}"
    class="profile-data-ad-container">
    @if($announcement['data']['status'] === 'ACTIVE')
        <div class="profile-data-ad-header">
            <button type="button" data-type="promote" class="profile-data-ad-header-btn rice-up-profile-btn"
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
        <img src="{{"http://evinaznew.cms.kube.tisserv.net/upload/".$announcement['images'][0]['path']}}" alt=""
             class="profile-data-ad-img">
    </div>
    <div class="profile-data-ad-data-container">
        <p class="profile-data-ad-address">
            @if(isset($announcement['data']['metro']))
                {{FallBackLanguage(getMetroName(@$announcement['data']['metro'])['data']['title'])}}
            @elseif(isset($value['data']['marker']))
                {{@FallBackLanguage(getMarkerName(@$announcement['data']['marker'])['data']['title'])}}
            @else
                {{FallBackLanguage(@getProvienceName(@$announcement['data']['provience'])['data']['title'])}}
            @endif        </p>
        <div class="profile-data-ad-data-wrapper">

            <div class="profile-data-ad-data">
                <div class="profile-data-ad-data-item">
                    <img src="/assets/images/room.svg" alt="">
                    <p>{{(@$announcement['data']['bedroom-count'] ?? 0)}}</p>
                </div>
                <div class="profile-data-ad-data-item">
                    <img src="/assets/images/area.svg" alt="">
                    <p>{{$announcement['data']['area'] ?? ''}}&#13217;</p>
                </div>
                <div class="profile-data-ad-data-item">
                    <img src="/assets/images/shower.svg" alt="">
                    <p>{{(@$announcement['data']['guestroom-count'] ?? 0)}}</p>
                </div>
                <div class="profile-data-ad-data-item">
                    <img src="{{"/assets/images/rank.svg"}}" alt="">
                    <p>
                        <span>{{@$announcement['data']['current-floor']}}</span>/
                        <span>{{@$announcement['data']['total-floors']}}</span>
                    </p>
                </div>
            </div>

            <p class="profile-data-ad-date">{{@FallBackLanguage(getCityName($announcement['data']['city'])['data']['title'])}}, {{date('d.m.Y', strtotime($announcement['data']['create-date'] ?? ''))}}</p>

        </div>


    </div>
    <div class="profile-data-ad-footer">
        <p class="profile-data-ad-amount">{{@$announcement['data']['price']}} AZN</p>
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
