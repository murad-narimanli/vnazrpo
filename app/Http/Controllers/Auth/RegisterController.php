<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Validations\OtpValidator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    private $username = "2450";
    private $password = "EVNzK28";
    private $number_id = "1409";
    private $sms_service_url = "http://213.172.86.6:8080/SmileWS2/webSmpp.jsp";

    use RegistersUsers;


    public function redirectToFacebook(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(): \Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->registerOrLoginUserFacebook($user);
        return redirect("/");
    }

    protected function registerOrLoginUserFacebook($data)
    {
        $user = $this->issetUser($data);

        if (!$user) {
            $user = User::create([
                'data.name' => $data['name'],
                'data.email' => $data['email'],
                'phone' => null,
                'data.type' => null,
                'data.agree' => true,
                'data.subscribe' => null,
                'password' => uniqid(),
            ]);
        }

        Auth::login($user);

        return redirect("/");
    }

    private function issetUser($data)
    {
        return User::where('data.email', $data->email)->first();
    }

    public function redirectToGoogle(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): \Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->registerOrLoginUserGoogle($user);
        return redirect("/");
    }

    private function registerOrLoginUserGoogle($data)
    {
        $user = $this->issetUser($data);
        if (!$user) {

            $user = User::create([
                'data.name' => $data['name'],
                'data.email' => $data['email'],
                'phone' => null,
                'data.type' => null,
                'data.agree' => true,
                'data.subscribe' => null,
                'password' => uniqid(),
            ]);
        }

        Auth::login($user);
        return redirect("/");
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $merchantType = \App\Models\MerchantType::orderBy('publishDate', 'desc')->get();
        return view('register', ['types' => $merchantType]);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:user'],
            'type' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree' => ['accepted'],
            'subscribe' => [],
            'code' => [new OtpValidator(@$data["otpRequestId"])]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return string[]
     */
    protected function create(array $data)
    {

        return User::create([
            'data.name' => $data['name'],
            'data.email' => $data['email'],
            'phone' => $data['phone'],
            'data.type' => $data['type'],
            'data.agree' => true,
            'data.subscribe' => (bool)($data['subscribe'] ?? 0),
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function register(Request $request)
    {
        $response = [];
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:user'],
            'type' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree' => ['accepted'],
            'subscribe' => [],
        ];
        if (isset($request->otp) && isset($request->requestId)) {
            $rules['otp'] = ['required'];
            $rules['requestId'] = ['required'];
        }
        $messages = array(
            'name.required' => 'Ad mütləq olmalıdır!',
            'phone.required' => 'Nömrə mütləq olmalıdır!',
            'phone.unique' => 'Nömrə daha əvvəl qeydiyyatdan keçib',
            'type.required' => 'Hesab növü mütləq olmalıdır!',
            'email.required' => 'E-poçt  mütləq olmalıdır!',
            'email.email' => 'E-poçt  formatı yanlışdır!',
            'password.required' => 'Şifrə mütləq olmalıdır!',
            'password.min' => "Şifrə minimium 8(səkkiz) xaraketdən ibarət olmalıdır",
            'password.confirmed' => "Daxil edilən şifrələr eyni deyil!",
            'subscribe.accepted' => "Şərtlər qəbul edilməlidir!",
            'code.required' => "OTP kod mütləq göndərilməlidir!",
            'requestId.required' => "OTP kod mütləq göndərilməlidir!"
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $statusCode = 422;
            $response['messages'] = $validator->messages();
        } else {
            if (!isset($request->otp) || !isset($request->requestId)) {
                $statusCode = 403;
                $request_id = uniqid();
                $otp_code = $this->sendOtp($request->phone);
                Otp::create([
                    'data.code' => $otp_code,
                    'data.requestId' => $request_id,
                    'data.phoneNumber' => $request->phone,
                    'data.userId' => 111111
                ]);
                $response['requestId'] = $request_id;
            } else {
                $exists = Otp::where([
                    'data.requestId' => $request->requestId,
                    'data.code' => (int)$request->otp
                ])->exists();
                if ($exists) {
                    $statusCode = 200;
                    $response['message'] = "success";
                    User::create([
                        'data.name' => $request->name,
                        'data.email' => $request->email,
                        'phone' => $request->phone,
                        'data.type' => $request->type,
                        'data.agree' => true,
                        'data.subscribe' => (bool)($request->subscribe ?? 0),
                        'password' => Hash::make($request->password),
                    ]);
                } else {
                    $statusCode = 400;
                    $response['message'] = "OTP kod səhvdi!";
                }
            }
        }
        return response()->json($response, $statusCode);
    }

    private function sendOtp($phone_number)
    {
        $otp_code = rand(100000, 999999);
        $message = "OTP code: " . $otp_code;
        Http::get($this->sms_service_url, [
            'username' => $this->username,
            'password' => $this->password,
            'numberId' => $this->number_id,
            'msisdn' => "994$phone_number",
            'msgBody' => $message,
        ]);

        return $otp_code;
    }

}
