<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

use function Flasher\Prime\flash;

class AccountVerificationController extends Controller
{
    /**
     * Send a verification code to the user's email
     * 
     * @param string $hash The hashed email address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendCode($hash): RedirectResponse
    {
        $identifier = decrypt($hash);
        $this->codeGenarate($identifier);
        flash()->success('Verification OTP send successfuly!');
        return Redirect::route('verifyAccount', [$hash]);
    }

    /**
     * Render the verification account page
     * 
     * @param string $hash The hashed email address
     * @return \Illuminate\View\View
     */
    public function verifyAccount($hash): View
    {
        return view('auth.verify-account');
    }
    
    /**
     * Verifies the user's account by validating the OTP sent to their email address
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verification(Request $request): RedirectResponse
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

            flash()->success('Your account verify successfuly!');
            return Redirect::route('dashboard');
        }
        else {
            flash()->success('Your account verify successfuly!');
            return redirect()->route(
                'password.reset',
                [
                    'code'  => encrypt($request->otp),
                    'email' => encrypt($request->email)
                ]
            );
        }
    }

    /**
     * Generates a verification code and saves it to the database.
     *
     * @param string $identifier The identifier (email) associated with the verification code.
     *
     * @return void
     */
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
