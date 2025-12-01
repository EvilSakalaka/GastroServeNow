<nav x-data="{ open: false }" class="bg-white border-b border-gold-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- PUBLIKUS ÉTLAP - CSAK VENDÉGEK (bejelentkezés nélkül) -->
                    @if (!Auth::check())
                        <x-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">
                            {{ __('Étlap') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'manager')
                        <x-nav-link :href="route('waiter.dashboard')" :active="request()->routeIs('waiter.dashboard')">
                            {{ __('Pincér') }}
                        </x-nav-link>

                        <x-nav-link :href="route('chef.dashboard')" :active="request()->routeIs('chef.dashboard')">
                            {{ __('Séf') }}
                        </x-nav-link>

                        <x-nav-link :href="route('bartender.dashboard')" :active="request()->routeIs('bartender.dashboard')">
                            {{ __('Pultos') }}
                        </x-nav-link>

                        <x-nav-link :href="route('manager.admin_page')" :active="request()->routeIs('manager.admin_page')">
                            {{ __('Manager') }}
                        </x-nav-link>

                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Új felhasználó') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profilom') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Kijelentkezés') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- BEJELENTKEZÉS NÉLKÜL - LOGIN GOMB -->
                    <a href="{{ route('login') }}" class="text-gold-600 font-semibold hover:text-gold-700 transition">
                        {{ __('Bejelentkezés') }}
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- PUBLIKUS ÉTLAP - CSAK VENDÉGEK (mobilon) -->
            @if (!Auth::check())
                <x-responsive-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">
                    {{ __('Étlap') }}
                </x-responsive-nav-link>
            @endif

            @if (Auth::check() && Auth::user()->role == 'manager')
                <x-responsive-nav-link :href="route('waiter.dashboard')" :active="request()->routeIs('waiter.dashboard')">
                    {{ __('Pincér') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('chef.dashboard')" :active="request()->routeIs('chef.dashboard')">
                    {{ __('Séf') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('bartender.dashboard')" :active="request()->routeIs('bartender.dashboard')">
                    {{ __('Pultos') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('manager.admin_page')" :active="request()->routeIs('manager.admin_page')">
                    {{ __('Manager') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Új felhasználó') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::check())
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            @endif

            <div class="mt-3 space-y-1">
                @if (Auth::check())
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profilom') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Kijelentkezés') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Bejelentkezés') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
</nav>