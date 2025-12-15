<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function forgot()
    {
        return view('auth.forgot-password');
    }

    public function forgotCode(Request $request)
    {
        return redirect()->route('send.code', [encrypt($request->email)]);
    }

    public function reset(Request $request)
    {
        $code = decrypt($request->code);
        $email = decrypt($request->email);

        return view('auth.reset-password', compact('email', 'code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email|exists:verification_codes,identifier',
            'otp' => 'required|exists:verification_codes,code',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password),
            ]);

            VerificationCode::where('identifier', $request->email)->delete();

            DB::commit();
            
            flash()->success('Password reset successfuly!');
            return Redirect::route('welcome');
        } catch (\Throwable $th) {
            DB::rollBack();
            flash()->error('Oops! Something went wrong.');
            return Redirect::back();
        }
    }
    
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
