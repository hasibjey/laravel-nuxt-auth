<x-guest-layout>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" required autofocus
                       class="form-control @error('email') border-red-500 @enderror"
                       value="admin@gmail.com">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                       class="form-control @error('password') border-red-500 @enderror" value="password">
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Login
                </button>
                @if (Route::has('forgot.password'))
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('forgot.password') }}">
                        Forgot Your Password?
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>