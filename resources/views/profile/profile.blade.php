@extends('profile/layout')

@section('profileContent')
    <div class="profile-data-container profile-data-container-info" id="profile-data-container-info">
        <ul class="profile-data-info-list">
            <li class="profile-data-info-item">
                <p class="profile-data-info-item-label">{{T("Ad")}}</p>
                <input disabled type="text" id="name" value="{{$user['data']['name'] ?? ''}}"
                       class="profile-data-info-item-input">
                <button class="profile-data-info-item-btn edit active">
                    <span>{{T("Düzəliş et")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
                <button class="profile-data-info-item-btn save" onclick="setProfileInfo('name')">
                    <span>{{T("Yadda saxla")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
            </li>
            <li class="profile-data-info-item">
                <p class="profile-data-info-item-label">{{T("E-poçt")}}</p>
                <input disabled type="text" id="email" value="{{$user['data']['email'] ?? ''}}"
                       class="profile-data-info-item-input">
                <button class="profile-data-info-item-btn edit active">
                    <span>{{T("Düzəliş et")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
                <button class="profile-data-info-item-btn save" onclick="setProfileInfo('email')">
                    <span>{{T("Yadda saxla")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
            </li>
            <li class="profile-data-info-item">
                <p class="profile-data-info-item-label">{{T("Mobil nömrə")}}</p>
                <input disabled type="text" id="phone" value="{{$user['phone'] ?? ''}}"
                       class="profile-data-info-item-input">
                <button class="profile-data-info-item-btn edit active">
                    <span>{{T("Düzəliş et")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
                <button class="profile-data-info-item-btn save" onclick="setProfileInfo('phone')">
                    <span>{{T("Yadda saxla")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
            </li>
            <li class="profile-data-info-item">
                <p class="profile-data-info-item-label">{{T("Şifrə")}}</p>
                <input disabled type="password" id="password" value="12345678"
                       class="profile-data-info-item-input">
                <button class="profile-data-info-item-btn edit active">
                    <span>{{T("Düzəliş et")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
                <button class="profile-data-info-item-btn save" onclick="setProfileInfo('password')">
                    <span>{{T("Yadda saxla")}}</span>
                    <img src="{{asset('assets/profile/images/edit.svg')}}" alt="">
                </button>
            </li>
        </ul>
    </div>
@endsection
