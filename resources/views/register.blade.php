@extends('index')
@php
    use \Illuminate\Support\Facades\App;
    use \Illuminate\Support\Facades\Session;
    App::setLocale(Session::get('language') ?? App::getLocale());
@endphp
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
                <div class="flex sign-up-inner">
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
                    <div class="sign-up-first-section-right-hand mobile-login-card">
                        <div class="sign-up-first-section-right-hand-header">
                            <h1>{{T("Qeydiyyatdan keç")}}</h1>
                        </div>

                        <div class="sign-in-btns social__buttons sign-in-social-btn-mobile">
                            <a href="/googleRedirect">
                                <button type="button" class="fa-google-div"><i class="fab fa-google"></i>
                                    <p>Google</p>
                                </button>
                            </a>
                            <a class="fb-parent-mob" href="/facebookRedirect">
                                <button type="button" class="fa-facebook-square-div"><i
                                        class="fab fa-facebook-square"></i>
                                    <p>Facebook</p>
                                </button>
                            </a>
                        </div>


                        <form id="registerForm" class="sign-up-first-section-right-hand-body" method="post"
                              action="{{langUrlPrefix()}}/register">
                            <input type="hidden" name="otpRequestId">
                            @csrf
                            <div id="form-data">
                                @foreach ($errors->all() as $error)
                                    <div class="sign-up-notification">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <p>{{$error}}</p>
                                    </div>
                                @endforeach
                                <div class="sign-up-first-section-right-hand-body-first">
                                    <label for="">{{T("Ad, soyad")}}</label>
                                    <input class="sign-in-phone-mob" id="full-name" type="text"
                                           placeholder="Ad və soyad" name="name"
                                           value="{{old('name')}}"
                                           @error('name') style="border: 1px dashed #f6a2a2!important; min-width: 100%;" @enderror>
                                    <p id="full-name-error"
                                       style="color: #f6a2a2; margin-bottom: 0; margin-top: 5px; display: none;">Error
                                        text</p>
                                </div>
                                <div class="sign-up-first-section-right-hand-body-first">
                                    <label for="">{{T("Telefon")}}</label>

                                    <div class="sign-up-first-section-right-hand-body-number">
                                        <div>+994</div>
                                        <input class="sign-in-phone-mob" type="text" name="phone" id="sign-in-phone"
                                               required
                                               value="{{old('phone')}}"
                                               @error('phone') style="border: 1px dashed #f6a2a2 !important;" @enderror>
                                    </div>
                                    <p id="reg-phone-error"
                                       style="color: #f6a2a2; margin-bottom: 0; margin-top: 5px; display: none;">Error
                                        text</p>
                                    @error('phone') <p
                                        style="color: #f6a2a2; margin-bottom: 0px !important;">{{$message}}</p> @enderror
                                </div>

                                <div class="sign-up-first-section-right-hand-body-first" id="right-hand-body-first">
                                    <div class="new-pass-section">
                                        <label for="">{{T("Yeni şifrə")}}</label>

                                        <div class="reg-pass">
                                            <input type="password" id="sign-in-password" class="firstPassAgain showPass"
                                                   name="password"
                                                   required
                                                   @error('password') style="border: 1px dashed #f6a2a2!important;" @enderror>
                                            <i class="far fa-eye-one fa-eye"></i>
                                        </div>
                                        <p id="reg-password-error"
                                           style="color: #f6a2a2; margin-bottom: 0; margin-top: 5px; display: none;">
                                            Error
                                            text</p>
                                    </div>

                                    <div class="new-pass-section-repeat">
                                        <label for="">{{T("Yeni şifrə təkrar")}}</label>

                                        <div class="reg-pass">
                                            <input type="password" id="sign-in-confirm-password"
                                                   class="secondPassAgain showPass"
                                                   name="password_confirmation"
                                                   required>
                                            <i class="far fa-eye-two fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                @error('password') <p
                                    style="color: #f6a2a2; margin-bottom: 0px !important;">{{$message}}</p> @enderror

                                <div class="sign-up-pay-type">
                                    <div class="sign-up-pay-type-div">
                                        <h5>{{T("Hesab növü:")}}</h5>
                                    </div>
                                    <div class="sign-up-user-div sign-up-user-div-mob" required
                                         @error('type') style="border: 1px dashed #f6a2a2!important;" @enderror>
                                        <div>
                                            <select name="type" id="sign-in-type" class="select" required>
                                                @foreach($types as $value)
                                                    <option
                                                        value="{{$value->_id}}" {{old('type') == $value->_id ? 'selected' : ''}}>{{FallBackLanguage($value['data']['title'])}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p id="reg-type-error"
                                           style="color: #f6a2a2; margin-bottom: 0; margin-top: 5px; display: none;">
                                            Error
                                            text</p>
                                    </div>
                                </div>

                                <div class="sign-upchanges">
                                    <div>
                                        <input type="checkbox"
                                               name="subscribe" {{old('subscribe') == 'on' ? 'checked' : ''}}>
                                        <label>{{T("Yeniliklər haqqında email almaq istəyirəm")}}</label>
                                    </div>

                                    <i class="fas fa-info-circle"></i>

                                    <div class="hidden-information-box">
                                        <div class="hidden-information">
                                            <p>{{T("Yeniliklər haqqında email almaq istəyirəm haqqında qısa bir mətn")}}</p>
                                        </div>
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>

                                <div class="sign-up-mail" style="display: none">
                                    <label for="">{{T("Elektron poçt")}}</label>
                                    <input type="email" name="email" value="{{old('email')}}"
                                           @error('email') style="border: 1px dashed #f6a2a2!important;" @enderror>
                                </div>

                                <div class="sign-up-input">
                                    <input type="checkbox" id="sign-in-agree" name="agree"
                                           required {{old('agree') == 'on' ? 'checked' : ''}}>
                                    <label for=""><a
                                            href="{{langUrlPrefix()}}/rules">{{T("İstifadəçi qaydalarını")}}</a> {{T("oxudum və qəbul edirəm.")}}
                                    </label>
                                </div>
                                <p id="reg-agree-error"
                                   style="color: #f6a2a2; margin-bottom: 10px; margin-top: 0px; display: none;">Error
                                    text</p>

                                <div class="sign-up-button">
                                    <button id="send-otp" onclick="signIn()"
                                            type="button">{{T("Qeydiyyatdan keç")}}</button>
                                </div>
                            </div>
                            <input type="hidden" name="code">
                            <div class="sign-up-otp" style="display: none">
                                <div class="sign-up-otp-div">
                                    <h5>{{T("OTP Kodu təsdiqlə")}}</h5>
                                    <p>{{T("OTP Kodu təsdiqlə altındakı qısa mətn")}}</p>
                                </div>

                                <div id="otp-inputs" class="sign-up-inputs">

                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-1"
                                           name="digit-1" required data-next="digit-2">
                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-2"
                                           name="digit-2" required data-next="digit-3" data-previous="digit-1">
                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-3"
                                           name="digit-3" required data-next="digit-4" data-previous="digit-2">
                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-4"
                                           name="digit-4" required data-next="digit-5" data-previous="digit-3">
                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-5"
                                           name="digit-5" required data-next="digit-6" data-previous="digit-4">
                                    <input class="otp-input" autofocus type="number" maxlength="1" id="digit-6"
                                           name="digit-6" required data-previous="digit-5">
                                </div>

                                <p id="otp-message-error"
                                   style="color: #f6a2a2; margin-bottom: 5px; margin-top: 0; display: none;">Error
                                    text
                                </p>

                                <div class="comfirm-btn">
                                    <button type="button" onclick="signInOtp()"
                                            id="verify-otp">{{T("Təsdiqlə")}}</button>
                                </div>
                            </div>

                            <div class="sign-in-btns social__buttons sign-in-social-btn-web" style="padding: 0;">
                                <a href="/googleRedirect">
                                    <button type="button" class="fa-google-div"><i class="fab fa-google"></i>
                                        <p>Google</p>
                                    </button>
                                </a>
                                <a class="fb-parent-mob" href="/facebookRedirect">
                                    <button type="button" class="fa-facebook-square-div"><i
                                            class="fab fa-facebook-square"></i>
                                        <p>Facebook</p>
                                    </button>
                                </a>
                            </div>

                        </form>




                        <div class="sign-up-registration-btn">
                            <p>{{T("Hesabınız var?")}}</p>
                            <p><a href="{{langUrlPrefix()}}/login">{{T("Daxil ol")}}</a></p>
                        </div>
                    </div>
                </div>
            </section>
        </article>
    </main>
    <br><br>

    <script src="https://unpkg.com/imask"></script>

    <script>
        // $(document).ready(function () {
        //     $("button#send-otp").on("click", function (e) {
        //         const form = $("div#form-data");
        //         const data = $("form#registerForm").serializeArray();
        //         $.post("/send-otp", data)
        //             .done(function (data) {
        //                 form.hide();
        //                 $("form#registerForm input[name=otpRequestId]").val(data.otpRequestId);
        //                 $("div.sign-up-otp").show();
        //             });
        //     });
        //     $("div#otp-inputs input[type=number]").on("change", function (e) {
        //         let otp = "";
        //         $("div#otp-inputs input[type=number]").each((k, i) => otp = otp + $(i).val());
        //         $("form#registerForm input[name=code]").val(otp);
        //
        //     })
        //     $('input[name="subscribe"]').change(function () {
        //         if ($(this).is(":checked")) {
        //             $('.sign-up-mail').slideDown(100);
        //             $('input[name="email"]').attr("required", "required");
        //         } else {
        //             $('.sign-up-mail').slideUp(100);
        //             $('input[name="email"]').removeAttr("required");
        //         }
        //     }).change();
        // });

        var requestId;
        var regBody;

        function signIn() {
            const phone = $('#sign-in-phone').val().replace(/\-/g, '');
            regBody = {
                name: $('#full-name').val(),
                type: $('#sign-in-type').val(),
                // email: $('#full-name').val(),
                password: $('#sign-in-password').val(),
                password_confirmation: $('#sign-in-confirm-password').val(),
                agree: $('#sign-in-agree').is(':checked'),
                phone: phone,
            }

            $.post('/registerNew', regBody)
                .done(function (respone) {
                    console.log(respone)
                })
                .fail(function (xhr) {
                    if (xhr.responseJSON.requestId) {
                        requestId = xhr.responseJSON.requestId;
                        $("div#form-data").hide();
                        $("div.sign-up-otp").show();
                    }
                    if (xhr.responseJSON.messages) {
                        const message = xhr.responseJSON.messages;
                        $('#full-name-error').text('')
                        $('#reg-phone-error').text('')
                        $('#reg-type-error').text('')
                        $('#reg-password-error').text('')
                        $('#reg-agree-error').text('')

                        if (message.name) {
                            $('#full-name-error').text(message.name)
                            $('#full-name-error').show();
                        }
                        if (message.phone) {
                            $('#reg-phone-error').text(message.phone)
                            $('#reg-phone-error').show();
                        }
                        if (message.type) {
                            $('#reg-type-error').text(message.type)
                            $('#reg-type-error').show();
                        }
                        if (message.password) {
                            $('#reg-password-error').text(message.password)
                            $('#reg-password-error').show();
                        }
                        if (message.agree) {
                            $('#reg-agree-error').text(message.agree)
                            $('#reg-agree-error').show();
                        }
                    }

                });
        }


        function signInOtp() {
            let otp = "";
            $("div#otp-inputs input[type=number]").each((k, i) => otp = otp + $(i).val());
            const otpBody = {
                ...regBody,
                requestId: requestId,
                otp: otp
            }

            $.post('/registerNew', otpBody)
                .done(function (response) {
                    console.log('response', response)
                    if (response.message === 'success') {
                        window.location.href = window.location.href.replace('register', 'login');
                    }
                })
                .fail(function (xhr) {
                    $('#otp-message-error').text('')
                    const otpMessage = xhr.responseJSON.message;
                    if (otpMessage) {
                        $('#otp-message-error').text(otpMessage)
                        $('#otp-message-error').show();
                    }
                });

        }


        var element = document.getElementById('sign-in-phone');
        var maskOptions = {
            mask: '00-000-00-00'
        };
        var mask = IMask(element, maskOptions);


    </script>
@endsection
