<header class="py-2 px-3 border-b border-side-secondary mb-1">
    <div class="grid grid-cols-2">
        <ul class="flex flex-row items-center">
            <li
                class="nav-bar relative py-2 px-3 text-side-secondary cursor-pointer transition-300 hover:text-content-primary">
                <i class="fas fa-bars"></i>
            </li>
        </ul>
        <ul class="flex flex-row items-center justify-end">
            <li class="relative py-2 px-3 text-side-secondary cursor-pointer transition-300 hover:text-content-primary">
                <i class="far fa-comment-dots"></i>
                <span
                    class="text-[.625rem] bg-red-500 text-white w-4 h-4 rounded-sm flex flex-row justify-center items-center absolute -top-1 right-0">3</span>
            </li>
            <li class="relative py-2 px-3 text-side-secondary cursor-pointer transition-300 hover:text-content-primary">
                <i class="far fa-bell"></i>
                <span
                    class="text-[.625rem] bg-red-500 text-white w-4 h-4 rounded-sm flex flex-row justify-center items-center absolute top-0 right-0">3</span>
            </li>
            <li class="relative py-2 px-3 text-red-500 cursor-pointer scale-100 transition-300 hover:text-red-500 hover:scale-125"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i>
            </li>
        </ul>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
    </form>
</header>
