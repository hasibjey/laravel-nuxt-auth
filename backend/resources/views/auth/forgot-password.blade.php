<x-guest-layout>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
        <form method="POST" action="{{ route('forgot.password') }}">
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
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Forgot Password
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>