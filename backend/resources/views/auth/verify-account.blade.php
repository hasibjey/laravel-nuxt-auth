<x-guest-layout>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Account Verification</h2>

        @if(session('error'))
            <p class="form-error text-center">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('verification.account') }}">
            @csrf

            <input type="hidden" name="email" value="{{ decrypt(request()->hash) }}">

            <div class="">
                <label for="email" class="block text-gray-700 mb-1">Enter your OTP</label>
                <div style="display:flex; gap:10px; justify-content:center;">
                    @for ($i = 0; $i < 5; $i++)
                        <input type="text"
                               inputmode="numeric"
                               pattern="[0-9]*"
                               maxlength="1"
                               class="otp-input form-control text-center @error('otp') border-red-500 @enderror"
                               name="otp[]">
                    @endfor
                </div>
                @error('otp')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5 flex justify-between gap-3 items-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                    Verify
                </button>

                <p id="countdown"></p>

                <a type="button" href="{{ route('send.code', request()->hash) }}"
                   id="resend"
                   class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600"
                   style="display:none;">
                   Resend code
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
