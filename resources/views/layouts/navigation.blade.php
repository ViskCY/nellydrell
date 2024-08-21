<nav x-data="{ open: false }" class="border-b border-gray-100 dark:border-gray-900" style="background-color: #000000;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex mr-2">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-nav-link :href="route('home')" class="font-bold text-gray-700 dark:text-gray-200 ml-3 border-none">
                        <img class="mx-auto dark:text-white h-10 sm:h-8 lg:h-16" src="{{ asset('storage/logo.png') }}" alt="Alt">
                    </x-nav-link>
                </div>
            </div>

            <!-- Search bar and Links -->
            <div class="flex items-center space-x-6">
                <!-- Search Bar (Visible on Desktop) -->
                <form action="{{ route('posts.index', ['query' => request()->query('query')]) }}" method="GET" class="hidden md:block">
                    <div class="relative mx-auto text-white w-full max-w-40 sm:max-w-40 md:max-w-lg lg:max-w-xl">
                        <input class="h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none w-full" style="background-color: #374151;" type="search" name="query" placeholder="{{ __('messages.search') }}">
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-3">
                            <svg class="text-white h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92c0.779,0,1.518-0.297,2.079-0.837  C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </form>




                <div x-data="{ isOpen: false }" class="relative ml-2">
                    <!-- Hamburger button -->
                    <button @click="isOpen = !isOpen" class="p-2 focus:outline-none md:hidden text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': isOpen, 'inline-flex': !isOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path :class="{'hidden': !isOpen, 'inline-flex': isOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Navigation links and Search Bar (Visible in Mobile Menu) -->
                    <div x-cloak :class="{ 'block': isOpen, 'hidden': !isOpen }" class="absolute right-0 mt-4 w-48 rounded-md overflow-hidden shadow-xl z-10" style="background-color: black;">
                        <!-- Search bar (visible in mobile menu) -->
                        <form action="{{ route('posts.index', ['query' => request()->query('query')]) }}" method="GET" class="block md:hidden px-4 py-2">
                            <div class="relative text-white w-full">
                                <input class="h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none w-full" style="background-color: #374151;" type="search" name="query" placeholder="{{ __('messages.search') }}">
                                <button type="submit" class="absolute right-0 top-0 mt-3 mr-3">
                                    <svg class="text-white h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92c0.779,0,1.518-0.297,2.079-0.837  C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                        <!-- Other navigation links -->
                        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.home')}}</a>
                        <a href="{{ route('posts.index') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.pics')}}</a>
                        <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.about')}}</a>
                        <a href="{{ route('cv') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.cv')}}</a>
                        <a href="{{ route('contacts') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.contacts')}}</a>
                        <hr>
                        @if (app()->getLocale() === 'et')
                            <a href="nellydrell.com" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{ __('English') }}</a>
                        @else
                            <a href="nellydrell.ee" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{ __('Eesti keel') }}</a>
                        @endif
                        @can('access-dashboards')
                            <hr>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">{{__('messages.dashboard')}}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>                       
</nav>
