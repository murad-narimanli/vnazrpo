@extends('profile/layout')

@section('profileContent')
    <div class="profile-data-container profile-data-container-balance"
         id="profile-data-container-balance">

        <div class="balance-row">
            <div class="balance-row-item">
                <p class="balance-row-item-label">Balans</p>
                <p class="balance-row-item-value">{{$userBalance}} AZN</p>
            </div>
            <div class="balance-row-item">
                <p class="balance-row-item-label">Ödənişli elanlar</p>
                <p class="balance-row-item-value">{{$payedOrderCount}}</p>
            </div>
            <div class="balance-row-item">
                <p class="balance-row-item-label">Pulsuz elanlar</p>
                <p class="balance-row-item-value">{{$freeOrderCount}}</p>
            </div>
        </div>
        <p class="balance-increases-title">
            Balansı artır
        </p>
        <div class="balance-increases-container">
            <div class="balance-increases-container-inner">
                <div class="balance-increases-amount-container">
                    <input placeholder="Məbləğ" type="text" class="balance-increases-input">
                    <p class="balance-increases-currency">AZN</p>
                </div>
                <!-- <div class="balance-increases-radio-list">
                    <label class="balance-increases-label">
                        <input name="payment-type" type="radio" class="balance-increases-radio">
                        <span class="balance-increases-radio-mask"></span>
                        <span class="balance-increases-radio-text">Bank kartı</span>
                    </label>
                    <label class="balance-increases-label">
                        <input name="payment-type" type="radio" class="balance-increases-radio">
                        <span class="balance-increases-radio-mask"></span>
                        <span class="balance-increases-radio-text">Portmanat</span>
                    </label>
                </div> -->
                <button class="balance-increases-btn">Ödə</button>
                <p class="balance-increases-note">
                    «Ödə» düyməsini sıxmaqla siz, Evin.az-ın <a href="">İstifadəçi razılaşmasını</a> və
                    <a href="">Qaydalarını</a> qəbul etmiş olursunuz
                </p>
            </div>
        </div>


    </div>
@endsection
