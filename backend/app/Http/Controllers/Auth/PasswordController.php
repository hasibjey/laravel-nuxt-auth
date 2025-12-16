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
use Illuminate\View\View;

class PasswordController extends Controller
{
    /**
     * Show the forgot password form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * view forgot password reset 
     */
    public function forgot(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Redirect the user to the send code route with the encrypted email address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email,role,admin',
        ]);
        return redirect()->route('send.code', [encrypt($request->email)]);
    }

    /**
     * Resets the user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reset(Request $request): View
    {
        $code = decrypt($request->code);
        $email = decrypt($request->email);

        return view('auth.reset-password', compact('email', 'code'));
    }

    /**
     * Resets the user's password.
     *
     * This function validates the request data, and if it's valid,
     * it updates the user's password and deletes the verification code.
     * If an error occurs, it rolls back the database transaction and
     * flashes an error message. If the operation is successful,
     * it flashes a success message and redirects the user to the welcome page.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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
