@extends('index')

@section('header')
    <link rel="stylesheet" href="{{asset('assets/sign-up/style.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/external.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/sign-up/mobile.css?cssv=4')}}">
    <link rel="stylesheet" href="{{asset('assets/profile/login-register.css?cssv=4')}}">
@endsection

@section('content')
    <main>
        <article>
            <section class="sign-up-first-section">
                <div class="flex sign-up-inner login__container">
                    <div class="sign-up-first-section-left-hand">
                        <table class="sign-up-first-section-left-hand-table">
                            <tr class="sign-up-first-section-left-hand-table-first">
                                <td class="sign-first-box">
                                    <div>
                                        <figure>
                                            <img src="{{asset('assets/icons/login-time-icon.svg')}}" alt="">
                                        </figure>
                                        <h3>Vaxtınıza qənaət edin</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <figure>
                                            <img src="{{asset('assets/icons/login-time-icon.svg')}}" alt="">
                                        </figure>
                                        <h3>Vaxtınıza qənaət edin</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="sign-up-first-section-left-hand-table-second">
                                <td class="sign-second-box">
                                    <div>
                                        <figure>
                                            <img src="{{asset('assets/icons/login-time-icon.svg')}}" alt="">
                                        </figure>
                                        <h3>Vaxtınıza qənaət edin</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <figure>
                                            <img src="{{asset('assets/icons/login-time-icon.svg')}}" alt="">
                                        </figure>
                                        <h3>Vaxtınıza qənaət edin</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="sign-in-section mobile-login-card">
                        <div class="sign-in-section-title login__title">
                            <h1>{{T("Giriş et")}}</h1>
                        </div>

                        <div class="sign-in-btns social__buttons sign-in-social-btn-mobile">
                            <a href="/googleRedirect">
                                <button type="button" class="fa-google-div"><i class="fab fa-google"></i>
                                    <p>Google</p>
                                </button>
                            </a>
                            <a href="/facebookRedirect">
                                <button type="button" class="fa-facebook-square-div"><i
                                        class="fab fa-facebook-square"></i>
                                    <p>Facebook</p>
                                </button>
                            </a>
                        </div>

                        <form action="/login" method="POST" class="sign-in-section-box">
                            @csrf
                            <div class="sign-in-section-box-div">
                                <label for="">{{T("Telefon")}}</label>
                                <div>
                                    <div>+994</div>
                                    <input oninput="setValueToHidden()" type="text" id="login-mobile-number"
                                           name="phone-mask" required value="{{old('phone')}}"
                                           @error('phone') style="border: 1px solid #f6a2a2 !important;" @enderror>
                                    <input type="hidden" name="phone" id="login-mobile-number-hidden">
                                </div>
                                @error('phone') <p
                                    style="color: #f6a2a2; margin-bottom: 0px !important;">{{$message}}</p> @enderror
                            </div>

                            <div class="sign-in-section-pass">
                                <label for="">{{T("Şifrə")}}</label>
                                <div>
                                    <input class="showPass" data-id="1" type="password" name="password" required>
                                    <i class="far fa-eye"></i>
                                </div>
                            </div>

                            <div class="sign-in-btn">
                                <button type="submit">{{T("Daxil ol")}}</button>
                            </div>

                            <div onclick="openPhoneEditPopup()" class="sign-in-btn-find-pass">
                                <p>{{T("Şifrəni unutmusunuz?")}}</p>
                            </div>

                            <div class="sign-in-btns social__buttons sign-in-social-btn-web">
                                <a href="/googleRedirect">
                                    <button type="button" class="fa-google-div"><i class="fab fa-google"></i>
                                        <p>Google</p>
                                    </button>
                                </a>
                                <a href="/facebookRedirect">
                                    <button type="button" class="fa-facebook-square-div"><i
                                            class="fab fa-facebook-square"></i>
                                        <p>Facebook</p>
                                    </button>
                                </a>
                            </div>

                        </form>

                        <div class="profile-sign-in">
                            <p>{{T("Hesabınız yoxdur?")}}</p>
                            <p class="profile-sign-in-a"><a
                                    href="{{langUrlPrefix()}}/register">{{T("Qeydiyyatdan keç")}}</a></p>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>
    <br><br>

    <div id="otp-code" class="popup-section">

        <div class="popup-content">
            <div class="forgetpass-popup">
                <div class="sign-in-section-title">
                    <h1 class="title-info">{{T("Şifrəni yenilə")}}</h1>
                    <button id="closePopup" class="popup-close-icon">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="/login" method="POST" class="sign-in-section-box digit-group" data-group-name="digits"
                      data-autosubmit="false" autocomplete="off">
                    @csrf

                    <div class="sign-in-section-pass">

                        <b style="margin-top: 15px;">{{T("OTP Kodu təsdiqlə")}}</b>
                        <label style="margin-top: 15px;" for="">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry. Lorem Ipsum has been </label>
                        <div class="otp-box">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-1" name="digit-1"
                                   required data-next="digit-2">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-2" name="digit-2"
                                   required data-next="digit-3" data-previous="digit-1">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-3" name="digit-3"
                                   required data-next="digit-4" data-previous="digit-2">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-4" name="digit-4"
                                   required data-next="digit-5" data-previous="digit-3">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-5" name="digit-5"
                                   required data-next="digit-6" data-previous="digit-4">
                            <input class="otp-input" autofocus type="number" maxlength="1" id="digit-6" name="digit-6"
                                   required data-previous="digit-5">
                        </div>
                        <p id="otpErrorText" style="color: #f6a2a2; margin-bottom: 0px !important; display: none">Error
                            text</p>

                    </div>

                    <div class="forgetpass-btn">
                        <button onclick="sendOtp()" type="button">Təsdiqlə</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <div id="new-pass" class="popup-section">
        <div class="popup-content">
            <div class="forgetpass-popup">
                <div class="sign-in-section-title">
                    <h1 class="title-info">Şifrəni yenilə</h1>
                    <button id="closePopup" class="popup-close-icon">
                        <i class="fas fa-times close-fas"></i>
                    </button>
                </div>
                <form action="/login" method="POST" class="sign-in-section-box">
                    @csrf
                    <div class="sign-in-section-pass">
                        <label style="margin-top: 15px;" for="">Yeni şifrə</label>
                        <div>
                            <input class="showPass" data-id="2" id="newPassword" type="password" name="password"
                                   required>
                            <i class="far fa-eye"></i>
                        </div>
                        <label style="margin-top: 5px;" for="">Yeni şifrə təkrar</label>
                        <div>
                            <input class="showPass" data-id="3" id="password" type="password" name="password" required>
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    <div class="forgetpass-btn">
                        <button onclick="sendNewPassword()" type="button">Təsdiqlə</button>
                    </div>
                </form>
                <p id="newPasswordErrorText" style="color: #f6a2a2; margin-bottom: 0px !important; display: none">Error
                    text</p>
            </div>
        </div>

    </div>

    <div id="info" class="popup-section">
        <div class="popup-content">
            <div class="forgetpass-popup">
                <div class="sign-in-section-title">
                    <h1 class="title-info">Məlumat</h1>
                    <button id="closePopup" class="popup-close-icon">
                        <i class="fas fa-times close-fas"></i>
                    </button>
                </div>
                <div class="sign-in-section-box">
                    <h5 class="forgetpass-text">
                        Sizin şifrəniz uğurla dəyişdirildi.
                    </h5>
                    <div class="forgetpass-btn">
                        <button onclick="closeSuccessPopup()" class="forgetpass-outline-btn" type="submit">Təsdiqlə
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="refresh-pass" class="popup-section">

        <div class="popup-content">
            <div class="forgetpass-popup">
                <div id="closePopup" class="sign-in-section-title">
                    <h1 class="title-info">Şifrəni yenilə</h1>
                    <button class="popup-close-icon">
                        <i class="fas fa-times close-fas"></i>
                    </button>
                </div>
                <form action="/login" method="POST" class="sign-in-section-box">
                    @csrf
                    <div class="forgetpass-section-box-div">
                        <label for="">Telefon</label>
                        <div>
                            <div>+994</div>
                            <input id="forgotPasswordPhoneInput" type="number" name="phone" required
                                   style="border: 1px solid #f6a2a2 !important;">
                        </div>
                        <p id="phoneNumberError" style="color: #f6a2a2; margin-bottom: 0px !important; display: none">
                            Error text</p>
                    </div>

                    <div class="forgetpass-btn" onclick="sentPhoneForResetPassword()">
                        <button type="button">Təsdiqlə</button>
                    </div>

                </form>
            </div>
        </div>

    </div>


    <script>
        function setValueToHidden() {
            setTimeout(() => {
                const number = $('#login-mobile-number').val()
                $('#login-mobile-number-hidden').val(+number.replace(/\-/g, ''))
            }, 5)
        }

        var element = document.getElementById('login-mobile-number');
        var maskOptions = {
            mask: '00-000-00-00'
        };
        var mask = IMask(element, maskOptions);
    </script>

@endsection
