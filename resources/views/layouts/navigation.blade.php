<nav x-data="{ open: false }" class="bg-white border-b border-gray-200/80 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 shrink-0">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-gray-800 tracking-tight">MoneyTrack</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:ml-8 md:space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-chart-pie w-4 text-center mr-1.5"></i>Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('incomes.index')" :active="request()->routeIs('incomes.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('incomes.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-arrow-trend-up w-4 text-center mr-1.5"></i>Pemasukan
                    </x-nav-link>
                    <x-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('expenses.*') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-arrow-trend-down w-4 text-center mr-1.5"></i>Pengeluaran
                    </x-nav-link>
                    <x-nav-link :href="route('savings-goals.index')" :active="request()->routeIs('savings-goals.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('savings-goals.*') ? 'bg-amber-50 text-amber-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-piggy-bank w-4 text-center mr-1.5"></i>Tabungan
                    </x-nav-link>
                    <x-nav-link :href="route('debts.index')" :active="request()->routeIs('debts.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('debts.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-file-invoice-dollar w-4 text-center mr-1.5"></i>Hutang
                    </x-nav-link>
                    <x-nav-link :href="route('budgets.index')" :active="request()->routeIs('budgets.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('budgets.*') ? 'bg-violet-50 text-violet-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-calculator w-4 text-center mr-1.5"></i>Anggaran
                    </x-nav-link>
                    <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('reports.*') ? 'bg-purple-50 text-purple-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i class="fas fa-chart-bar w-4 text-center mr-1.5"></i>Laporan
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden md:flex md:items-center md:gap-3">
                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="relative p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bell text-lg"></i>
                    @if(($unreadNotifications ?? 0) > 0)
                        <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $unreadNotifications }}</span>
                    @endif
                </a>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user mr-2 text-gray-400 w-4 text-center"></i>Profile
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('categories.index')">
                            <i class="fas fa-tags mr-2 text-gray-400 w-4 text-center"></i>Kategori
                        </x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2 text-gray-400 w-4 text-center"></i>Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-lg" x-show="!open"></i>
                    <i class="fas fa-times text-lg" x-show="open"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-chart-pie w-5 text-center"></i>Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('incomes.index')" :active="request()->routeIs('incomes.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('incomes.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-arrow-trend-up w-5 text-center"></i>Pemasukan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('expenses.*') ? 'bg-red-50 text-red-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-arrow-trend-down w-5 text-center"></i>Pengeluaran
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('savings-goals.index')" :active="request()->routeIs('savings-goals.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('savings-goals.*') ? 'bg-amber-50 text-amber-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-piggy-bank w-5 text-center"></i>Tabungan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('debts.index')" :active="request()->routeIs('debts.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('debts.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-file-invoice-dollar w-5 text-center"></i>Hutang
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('budgets.index')" :active="request()->routeIs('budgets.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('budgets.*') ? 'bg-violet-50 text-violet-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-calculator w-5 text-center"></i>Anggaran
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('reports.*') ? 'bg-purple-50 text-purple-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-chart-bar w-5 text-center"></i>Laporan
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('notifications.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-bell w-5 text-center"></i>Notifikasi
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('categories.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600' }}">
                <i class="fas fa-tags w-5 text-center"></i>Kategori
            </x-responsive-nav-link>
        </div>
        <div class="border-t border-gray-100 px-4 py-3">
            <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600">
                <i class="fas fa-user w-5 text-center"></i>Profile
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>Keluar
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>

