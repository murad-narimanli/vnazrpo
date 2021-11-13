@extends('profile/layout')

@section('profileContent')
    <div class="profile-data-container table-responsive profile-data-container-invoices"
         id="profile-data-container-invoices">

        {{--DESKTOP--}}
        <table class="desktop-table d-sm-table d-none profile-data-invoices-table">
            <thead>
                <tr>
                    <th>Status</th>
                    {{--                <th>Elan</th>--}}
                    <th>Hesab nömrəsi</th>
                    <th>XİDMƏTİN NÖVÜ</th>
                    <th>Məbləğ</th>
                    <th>Tarix</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $key => $value)
                <tr>
                    <td>Success</td>
                    {{--                    <td><a target="_blank" href="/object/{{$value['data']['announcement']}}">link</a></td>--}}
                    <td>{{$value['_id']}}</td>
                    <td>{{$value['data']['type']}}</td>
                    <td>{{$value['data']['amount'] / 100}} AZN</td>
                    <td>{{date("Y-m-d H:i:s", $value['publishDate'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--MOBILE--}}
        <table class="mob-table d-sm-none d-table profile-data-invoices-table">

            @foreach ($orders as $key => $value)


                <thead>
                    <tr>
                        <th>Status</th>
                        {{--                <th>Elan</th>--}}
                        <th>Hesab nömrəsi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Success</td>
                        {{--                    <td><a target="_blank" href="/object/{{$value['data']['announcement']}}">link</a></td>--}}
                        <td>{{$value['_id']}}</td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th>XİDMƏTİN NÖVÜ</th>
                        <th>Məbləğ</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{$value['data']['type']}}</td>
                        <td>{{$value['data']['amount'] / 100}} AZN</td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th colspan="2" >Tarix</th>
                    </tr>
                </thead>

                <tbody class="date-tbody" >
                    <tr class="date-tr" >
                        <td class="separator date-td" colspan="2" >{{$value['publishDate']}}</td>
                    </tr>
                </tbody>

            @endforeach

        </table>


    </div>
@endsection
