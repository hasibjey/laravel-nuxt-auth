<x-guest-layout>
    <x-slot name="title">Login</x-slot>

    <div class="bg-white shadow-[0_0_5px] shadow-side-secondary rounded-lg w-80 xl:w-3/12 py-4">
        <div class="border-b border-gray-200 py-4">
            <h1 class="text-3xl font-bold text-center">Admin Login</h1>
        </div>
        <div class="p-6">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="addon-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" placeholder="Email address" name="email"
                            value="{{ old('email') }}">
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
                <div class="form-group mt-6">
                    <button type="submit"
                        class="btn btn-primary w-full bg-blue-500 text-white !border-blue-500 hover:bg-blue-600">Login</button>
                </div>
            </form>

            @if (Route::has('forgot.password'))
                <a class="text-sm text-blue-500 hover:underline text-center block" href="{{ route('forgot.password') }}">
                    Forgot Your Password?
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>
