<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use function Flasher\Prime\flash;

class AccountVerificationController extends Controller
{
    public function sendCode($hash)
    {
        $identifier = decrypt($hash);
        $this->codeGenarate($identifier);
        flash()->success('Verification OTP send successfuly!');
        return Redirect::route('verifyAccount', [$hash]);
    }

    public function verifyAccount($hash)
    {
        return view('auth.verify-account');
    }

    public function verification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:verification_codes,identifier',
            'otp' => 'required|array'
        ]);

        $otp = implode('', $request->otp);

        $request->merge(['otp' => $otp]);

        $request->validate([
            'otp' => 'required|exists:verification_codes,code',
        ]);

        $verifyCode = VerificationCode::where('identifier', $request->email)->first();
        if($verifyCode->code !== $request->otp) {
            flash()->error('OTP is invalid!');
            return back();
        }

        if(Auth::guard('web')->check()) {
            User::where('email', Auth::guard('web')->user()->email)->update([
                'email_verified_at' => Carbon::now()
            ]);

            $verifyCode->delete();

            flash()->success('Your account verify successfuly!  ');
            return Redirect::route('dashboard');
        }
        else {
            return redirect()->route(
                'password.reset',
                [
                    'code'  => encrypt($request->otp),
                    'email' => encrypt($request->email)
                ]
            );
        }
    }

    private function codeGenarate($identifier)
    {
        $code = random_int(10000, 99999);

        VerificationCode::updateOrInsert(
            ['identifier' => $identifier],
            [
                'code' => $code,
                'created_at' => Carbon::now()
            ]
        );
    }
}
