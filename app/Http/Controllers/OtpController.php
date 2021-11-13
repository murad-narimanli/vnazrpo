<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{


    private $username = "2450";
    private $password = "EVNzK28";
    private $number_id = "1409";
    private $sms_service_url = "http://213.172.86.6:8080/SmileWS2/webSmpp.jsp";

    public function send(Request $request)
    {
        $request_id = uniqid();
        $phone_number = @$request->phone;
        $otp_code = $this->sendOtp($phone_number);
        Otp::create([
            'data.code' => $otp_code,
            'data.requestId' => $request_id,
            'data.phoneNumber' => $phone_number,
            'data.userId' => 1212  //Nicat burda userId də yazasan
        ]);

        return [
            'otpRequestId' => $request_id,
            'phoneNumber' => $phone_number
        ];
    }


    private function sendOtp($phone_number)
    {
        $message = "Otp code: {otp}";
        $otp_code = rand(100000, 999999);
        $message = str_replace("{otp}", $otp_code, $message);
        $response = Http::get($this->sms_service_url, [
            'username' => $this->username,
            'password' => $this->password,
            'numberId' => $this->number_id,
            'msisdn' => "994$phone_number",
            'msgBody' => $message,
        ]);

        return $otp_code;
    }

    public function verifyOtp($data)
    {
        $code = (int)@$data->code;
        $verified = Otp::where([
            'data.requestId' => @$data->email,
            'data.code' => $code
        ])->exists();

        return response()->json(
            ["verified" => $verified]
        );
    }
}
