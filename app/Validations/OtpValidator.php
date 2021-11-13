<?php


namespace App\Validations;

use App\Models\Otp;
use Illuminate\Contracts\Validation\Rule;

class OtpValidator implements Rule
{
    public $otpRequestId;

    public function __construct($otpRequestId)
    {
        $this->otpRequestId = $otpRequestId;
    }

    public function passes($attribute, $value)
    {
        return $this->isOtpVerified($this->otpRequestId, $value);
    }

    public function message()
    {
        return 'Otp duzgun deyil!';
    }


    private function isOtpVerified($otpRequestId, $code)
    {
        return Otp::where([
            'data.requestId' => $otpRequestId,
            'data.code' => (int)$code
        ])->exists();
    }
}
