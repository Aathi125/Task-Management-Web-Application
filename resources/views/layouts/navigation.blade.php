<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full shadow group-hover:scale-105 transition">
                    <span class="font-bold text-xl text-gray-900 dark:text-gray-100 tracking-tight group-hover:text-blue-600 transition">TaskMate</span>
                </a>
                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8 ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                            Categories
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                        Tasks
                    </x-nav-link>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="hidden md:flex items-center gap-4">
                <span class="text-sm text-gray-600 dark:text-gray-200 font-semibold">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff&size=64"
                     alt="Profile"
                     class="h-9 w-9 rounded-full border-2 border-blue-600 shadow"
                >
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="ml-2 flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 bg-white dark:bg-gray-900 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden hidden bg-white dark:bg-gray-900 px-4 pt-4 pb-2 border-b border-gray-100 dark:border-gray-700">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
        @if(auth()->user()->role === 'admin')
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">Categories</x-responsive-nav-link>
        @endif
        <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">Tasks</x-responsive-nav-link>
        <div class="border-t border-gray-200 dark:border-gray-700 mt-3 pt-3 flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff&size=64"
                 alt="Profile" class="h-8 w-8 rounded-full border-2 border-blue-600 shadow">
            <div>
                <div class="font-semibold text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                Log Out
            </x-responsive-nav-link>
        </form>
    </div>
</nav>
