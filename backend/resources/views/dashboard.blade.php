<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    
    <div class="h-screen-content overflow-auto">
        <!-- Breadcrumb -->
        <ul class="px-3 py-3 flex flex-row justify-end items-center gap-1">
            <li class="relative after:content-['/'] last:after:content-['']">
                Dashboard
            </li>
        </ul>

        <!-- Content -->
        <div class="px-3">
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <!-- Widgets -->
            <section class="grid grid-cols-4 gap-3 py-5">
                <!-- Item -->
                <div class="bg-teal-500 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="fas fa-shopping-basket text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5">150</p>
                        <p class="pb-4">New Orders</p>
                    </div>
                    <div class="py-1 bg-teal-600 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Item -->
                <div class="bg-green-600 rounded-sm text-white">
                    <div class="relative p-2.5">
                        <i
                            class="far fa-money-bill-alt text-6xl absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 opacity-50"></i>
                        <p class="text-4xl font-extrabold pb-2.5 flex flex-row items-center gap-1">
                            <span>1000</span>
                            <sup class="text-base">TK</sup>
                        </p>
                        <p class="pb-4">Monthly Sells</p>
                    </div>
                    <div class="py-1 bg-green-700 text-white text-sm rounded-b-sm">
                        <a href="" class="flex flex-row items-center justify-center gap-2">
                            <span>More info</span>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
</x-app-layout>
