<x-guest-layout>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="text" name="otp" value="{{ $code }}" class="hidden">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" required autofocus
                       class="form-control @error('email') border-red-500 @enderror"
                       value="{{ $email }}">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                @error('otp')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password"
                       class="w-full px-3 py-1.5 border rounded @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Confirm Password</label>
                <input id="password" type="password" name="password_confirmation"
                       class="w-full px-3 py-1.5 border rounded">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>