<section class="aside -left-full xl:left-0">
    <!-- company title -->
    <section
        class="px-3 py-2 flex flex-row items-center gap-2 border-b border-side-secondary transition-all duration-500">
        <img src="https://ui-avatars.com/api/?name=zarfcart" alt="" class="w-10 h-10 rounded-full">
        <a href="" class="flex-1 text-xl text-side-secondary font-light hover:text-white">Zarfcart</a>
    </section>

    <!-- user section -->
    {{-- <section class="flex flex-row items-center gap-2 p-3 border-b border-side-secondary">
        <img src="https://ui-avatars.com/api/?name={{ Auth::user()?->name }}" alt="" class="w-10 h-10 rounded-full">
        <a href="{{ route('profile.index') }}" class="flex-1 capitalize text-side-secondary hover:text-white">{{ Auth::user()?->name }}</a>
    </section> --}}

    <!-- navigation section -->
    <x-navigation-layout/>
</section>
