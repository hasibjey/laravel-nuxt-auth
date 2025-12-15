<x-guest-layout>
    <x-slot name="title">Set new password</x-slot>

    <div class="flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-3xl font-extrabold mb-3 text-center text-indigo-600">
                Set New Password
            </h2>
            <p class="mb-6 text-gray-600">
                Set a new password to keep your account secure and make sure only you can access it.
            </p>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="text" name="otp" value="{{ $code }}" class="hidden">

                <div class="form-group">
                    <div class="addon-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" placeholder="Email address" name="email"
                            value="{{ $email ?? old('email') }}" readonly>
                    </div>
                    @error('email')
                        <span class="zb-text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <div class="addon-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    @error('password')
                        <span class="zb-text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <div class="addon-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Confirm password"
                            name="password_confirmation">
                    </div>
                    @error('password')
                        <span class="zb-text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-5 flex justify-between gap-3 items-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
