<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    private $username = "2450";
    private $password = "EVNzK28";
    private $number_id = "1409";
    private $sms_service_url = "http://213.172.86.6:8080/SmileWS2/webSmpp.jsp";

//    use SendsPasswordResetEmails;

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

    public function numberCheck(Request $request)
    {
        if (isset($request->phone) && $request->phone != null) {
            $exits = false;
            $request_id = uniqid();
            $user = User::where('phone', $request->phone)->first();

            if ($user != null) {
                $otp_code = $this->sendOtp($request->phone);
                Otp::create([
                    'data.code' => $otp_code,
                    'data.requestId' => $request_id,
                    'data.phoneNumber' => $request->phone,
                    'data.userId' => $user->_id
                ]);
                $exits = true;
            }
            $response = [
                'status' => $exits,
                'requestId' => $request_id
            ];
            return response()->json([$response]);
        } else {
            abort(401);
        }

    }

    public function verifyOtp(Request $request)
    {
        if (isset($request->code) && $request->code != null && isset($request->requestId) && $request->requestId != null) {
            $code = (int)$request->code;
            $verified = Otp::where("data.requestId", $request->requestId)->where("data.code", $code)->first();
            return response()->json(
                [
                    "verified" => $verified != null,
                    'id' => $verified != null ? $verified->data['userId'] : null
                ]
            );
        } else {
            abort(401);
        }
    }

    public function changePassword(Request $request)
    {
        if (isset($request->id) && $request->id != null && isset($request->password) && $request->password != null && isset($request->newPassword) && $request->newPassword != null) {
            $result = false;
            $message = null;
            if (strlen($request->password) < 8) {
                $result = false;
                $message = "Şifrə 8-dən az ola bilməz!";
            } elseif ($request->password != $request->newPassword) {
                $result = false;
                $message = "Şifrələr uyğun gəlmir";
            } else {
                User::where("_id", $request->id)->update([
                    'password' => Hash::make($request->password)
                ]);
                $result = true;
                $message = "Əməliyyat icra edildi!";
            }

            return response()->json([
                    "result" => $result,
                    "message" => $message
                ]
            );
        } else {
            abort(401);
        }

    }
}
