<x-guest-layout>
    
    <x-slot name="title">Password reset</x-slot>

    <div class="flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-3xl font-extrabold mb-4 text-center text-indigo-600">
                Forgot Your Password?
            </h2>
            <p class="mb-6 text-gray-600">
                Don’t worry! Just enter your email and we’ll send you a link to reset your password 💌
            </p>
            <form method="POST" action="{{ route('forgot.password') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('email') }}" />
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Reset my password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>