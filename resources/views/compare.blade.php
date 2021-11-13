@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/compare/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection

@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale())
@endphp
@section('content')
    <main>
        <article>
            <section class="compare_section container">
                <div class="compare_section_title">
                    <h1>{{T("Müqayisə et")}}</h1>
                </div>

                <div class="compare_section-table">
                    <table>
                        <tr class="compare_section-table-titles">
                            <th class="compare_section-empty">
                            </th>
                            @foreach($compare as $value)
                                <th class="compare_section-table-title-imgs">
                                    <div class="compare_section-table-titles-icon">
                                        <i class="fas fa-times" onclick="removeFromCompare('{{$value['_id']}}')"></i>
                                    </div>
                                    <div class="compare_section-table-titles-img">
                                        <figure>
                                            <img
                                                src="http://evinaznew.cms.kube.tisserv.net/upload/{{$value['data']['images'][0]['path']}}"
                                                alt="">
                                        </figure>
                                        <div class="compare_section-table-title-h4">
                                            <h4> @if(isset($value['data']['metro']))
                                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                                @elseif(isset($value['data']['marker']))
                                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                                @else
                                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                                @endif</h4>
                                        </div>
                                    </div>
                                </th>
                            @endforeach

                        </tr>

                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">Qiymət</td>
                            @foreach($compare as $value)
                                <td class="compare_section-table-price price-dots">{{$value['data']['price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">Elan növü</td>
                            @foreach($compare as $value)
                                <td>{{\App\Models\AnnouncementType::find($value['data']['announcement-type'])['data']['title'][App::getLocale()] ?? ''}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Ümumi sahə")}}</td>
                            @foreach($compare as $value)
                                <td>{{$value['data']['area']}}&#13217;</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Mərtəbə")}}</td>
                            @foreach($compare as $value)
                                <td>{{$value['data']['current-floor'] ?? 1}}
                                    /{{$value['data']['total-floors'] ?? 1}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Yataq otağı")}}</td>
                            @foreach($compare as $value)
                                <td>{{$value['data']['bedroom-count'] ?? 0}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Qonaq otağı")}}</td>
                            @foreach($compare as $value)
                                <td>{{$value['data']['guestroom-count'] ?? 0}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Qaraj")}}</td>
                            @foreach($compare as $value)
                                <td>{{($value['data']['has-garage'] ?? false) ? 'Var' : 'Yoxdur'}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("Sənədin işi")}}</td>
                            @foreach($compare as $value)
                                <td>{{\App\Models\DocumentType::find($value['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? '-'}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("İpoteka")}}</td>
                            @foreach($compare as $value)
                                <td>{{\App\Models\IpotechType::find($value['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? '-'}}</td>
                            @endforeach
                        </tr>
                        <tr class="compare_section-table-values">
                            <td class="compare_section-table-difference-value">{{T("İnternet")}}</td>
                            @foreach($compare as $value)
                                <td>{{($value['data']['has-internet'] ?? false) ? 'Var' : 'Yoxdur'}}</td>
                            @endforeach
                        </tr>
                    </table>
                </div>

                <div class="table-mobile">
                    <table>
                        <tr class="compare_section-table-titles-mobile">

                            @foreach($compare as $value)
                                <th class="compare_section-table-title-imgs">
                                    <div class="compare_section-table-titles-icon">
                                        <i class="fas fa-times" onclick="removeFromCompare('{{$value['_id']}}')"></i>
                                    </div>
                                    <div class="compare_section-table-titles-img">
                                        <figure>
                                            <img
                                                src="http://evinaznew.cms.kube.tisserv.net/upload/{{@$value['data']['images'][0]['path']}}"
                                                alt="">
                                        </figure>

                                        <div class="compare_section-table-title-h4">
                                            <h4> @if(isset($value['data']['metro']))
                                                    {{FallBackLanguage(getMetroName(@$value['data']['metro'])['data']['title'])}}
                                                @elseif(isset($value['data']['marker']))
                                                    {{@FallBackLanguage(getMarkerName(@$value['data']['marker'])['data']['title'])}}
                                                @else
                                                    {{FallBackLanguage(@getProvienceName(@$value['data']['provience'])['data']['title'])}}
                                                @endif</h4>
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Qiymət")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td class="compare_section-table-price">{{$value['data']['price']}} {{\App\Models\CurrencyType::find($value['data']['currency'])->data['title'][App::getLocale()] ?? ''}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Elan növü")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{\App\Models\AnnouncementType::find($value['data']['announcement-type'])['data']['title'][App::getLocale()] ?? ''}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Ümumi sahə")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{$value['data']['area']}}&#13217;</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Mərtəbə")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{$value['data']['current-floor'] ?? 1}}
                                    /{{$value['data']['total-floors'] ?? 1}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T('Yataq otağı')}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{$value['data']['bedroom-count'] ?? 0}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Qonaq otağı")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{$value['data']['guestroom-count'] ?? 0}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Qaraj")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{($value['data']['has-garage'] ?? false) ? 'Var' : 'Yoxdur'}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("Sənədin işi")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{\App\Models\DocumentType::find($value['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? '-'}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("İpoteka")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{\App\Models\IpotechType::find($value['data']['document-type'] ?? '')['data']['title'][App::getLocale()] ?? '-'}}</td>
                            @endforeach
                        </tr>

                        <tr class="compare_section-table-values-mobile">
                            <td colspan="3">{{T("İnternet")}}</td>
                        </tr>

                        <tr class="compare_section-table-difference-value-mobile">
                            @foreach($compare as $value)
                                <td>{{($value['data']['has-internet'] ?? false) ? 'Var' : 'Yoxdur'}}</td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </section>
        </article>
    </main>
    <script>
        const removeFromCompare = (objectId) => {
            $.get('{{langUrlPrefix()}}/compare/remove/' + objectId, {}, (response) => {
                if (response.status == 'success') {
                    location.reload();
                }
            });
        }
    </script>
@endsection
