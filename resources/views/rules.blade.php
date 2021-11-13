@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/rules/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section class="rule-section">
                <div>
                    <div id="left-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>

                <div class="rule-container">
                    <div>
                        <div class="rule-title">
                            <h3>{{T("Qaydalar")}}</h3>
                        </div>

                        <div class="rule-content">
                            <p><span>1.1</span>Qaydalar https://evelani.az Servisin İstifadəçiləri tərəfindən istifadə şərtlərini müəyyən </p>
                            <p><span>1.2.</span>Həmin İstifadəçi Razılaşmanın məqsədləri üçün aşağıda göstərilən terminlər və təyinlər aşağıdakı mənada tətbiq olunur:</p>
                            <p><span>1.2.1.</span>Servis – İnternet şəbəkəsində https://evelani.az ünvanında yerləşdirilmiş İnternet-resursu (sayt)</p>
                            <p><span>1.2.2.</span>Administrasiya – Xidməti inzibatçılığını Azərbaycan Respublikasının qanunvericiliyinə uyğun olaraq yaradılmış (VÖEN 2006064072) şirkət həyat keçirir. İnternet resursuna aid bütün mülkiyyət hüquqları şirkətə aiddir.</p>
                            <p><span>1.2.3.</span>İstifadəçi – razılaşma şərtlərini qəbul etmiş və Servis xidmətlərindən istifadə edən istənilən hüquq səlahiyyəti olan şəxsdir.</p>
                            <p><span>1.2.4.</span>Şəxsi hesab – bu İstifadəçinin mühitinin İstifadəçi tərəfindən müəyyən edilmiş (yerləşdirilmiş) məlumatlar və qurmalar məcmusudur.</p>
                            <p><span>1.2.5.</span>İstifadəçinin şəxsi informasiyası – İstifadəçi haqqında məlumatlardır və ya məlumatlar məcmusudur ki, İstifadəçi özü haqqında, İstifadəçinin şəxsi məlumatları, Servisdən istifadə prosesində Administrasiyaya avtomatik olaraq ötürülən informasiya, o cümlədən IP-ünvan, cookie-dən informasiya, İstifadəçinin brauzeri haqqında və İstifadəçi haqqında başqa informasiyalar daxil olmaqla, qeydiyyat vaxtı sərbəst və ya Servisdən istifadə prosesində təqdim edir.</p>
                            <p><span>1.2.6.</span>İnformasiya – Servisdə İstifadəçi və ya Administrasiya tərəfindən yerləşdirilmiş istənilən informasiyadır.</p>
                            <p><span>1.2.7.</span>Spam – alanlar tərəfindən kütləvi, icazə verilməyən və/və ya gözlənməyən reklam, informasiya, təşviqat və ya başqa xarakterli poçt və başqa göndərilmələrdir.</p>
                            <p><span>1.2.8.</span>Əmlak – bu məhsul, işlər, xidmətlər, maddi-texniki resurslar, mülki və qeyri-mülki hüquqlardır.</p>
                            <p><span>1.2.9.</span>Həmin Razılaşmanın Tərəfləri – Administrasiya və İstifadəçidir.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="right-hand-advertisement">
                        <img src="{{asset('assets/images/reklam.jpg')}}" alt="">
                    </div>
                </div>
            </section>
        </article>
    </main>
@endsection
