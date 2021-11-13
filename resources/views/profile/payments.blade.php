@extends('profile/layout')

@section('profileContent')
    <div class="profile-data-container profile-data-container-invoices"
         id="profile-data-container-invoices">
        <table class="profile-data-invoices-table">
            <thead>
            <tr>
                <th>Status</th>
                <th>Məbləğ</th>
                <th>Tarix</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($payments as $key => $value)
                <tr>
                    <td>{{$value['data']['status']}}</td>
                    <td>{{$value['data']['price'] / 100}}</td>
                    <td>
                        {{$value['publishDate']->toDateTime()->format('Y-m-d H:i:s')}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
