<nav class="px-2 py-3">
    <ul class="flex flex-col gap-1">
        <li class="zb-nav-item">
            <a href="{{ route('dashboard') }}"
                class="zb-nav-link {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}">
                <span><i class="fas fa-tachometer-alt"></i></span>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Setting navigation -->
        <li class="zb-nav-item">
            <a href="javascript:void(0)"
                class="zb-nav-link {{ Route::is('permission.*', 'role.*', 'shipping.cost.*', 'coupon.*') ? 'active' : '' }}">
                <span><i class="fas fa-cogs"></i></span>
                <span class="pointer-events-none">Setting</span>
                <i class="fas fa-angle-left {{ Route::is('permission.*', 'role.*', 'shipping.cost.*', 'coupon.*') ? '-rotate-90' : 'rotate-0' }}"></i>
            </a>
            <ul
                class="zb-sub-nav-group py-0.5 flex-col gap-0.5 transition-300 {{ Route::is('permission.*', 'role.*', 'shipping.cost.*', 'coupon.*') ? 'sub-active' : '' }}">
                
                <li class="zb-sub-nav-item">
                    <a href="{{ route('permission.create') }}"
                        class="zb-sub-nav-link {{ Route::current()->getName() == 'permission.create' ? 'active' : '' }}">
                        <span class="zb-circle"></span>
                        <span>Permission</span>
                    </a>
                </li>
                <li class="zb-sub-nav-item">
                    <a href="{{ route('role.create') }}"
                        class="zb-sub-nav-link {{ Route::current()->getName() == 'role.create' ? 'active' : '' }}">
                        <span class="zb-circle"></span>
                        <span>Role</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
