<div class="relative bg-white shadow" x-data="{showMenu: false}">
    <div class="_max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="{{ route('pages', '') }}">
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    @svg('logos/pluggamatte', 'h-16 fill-primary text-primary')
                </a>
            </div>
            <div class="-mr-2 -my-2 md:hidden">
                <button type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
                        aria-expanded="false" @click="() => showMenu = true">
                    <span class="sr-only">Open menu</span>
                    <!-- Heroicon name: outline/menu -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <nav class="hidden md:flex space-x-10">
                @foreach(['home', 'about-us', 'contact'] as $page)
                    <a href="{{ route('pages', $page == 'home' ? '' : $page) }}"
                       class="text-base font-medium text-gray-500 hover:text-gray-900"> {{ __("general.{$page}") }} </a>
                @endforeach

                @php
                    $langMap = [
                        'sv_SE' => 'swedish',
                        'en' => 'english',
                    ]
                @endphp
                @if(false)

                    <div class="relative cursor-pointer"
                         x-data="{open: false, lang: {{ Illuminate\Support\Js::from(App::getLocale()) }}}"
                         @click.away="open = false">
                        <button
                            class="group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary text-gray-900 space-x-1"
                            @click="open = !open;">
                            @php
                                $icon = "icons/" . $langMap [ App::getLocale() ]
                            @endphp
                            @svg($icon, 'h-5 rounded-md')

                            @svg('icons/hero-chevron-down', 'h-5 text-gray-500 hover:text-gray-600')
                        </button>
                        <div
                            class="absolute -ml-4 mt-3 transform z-10 px-2 w-screen max-w-fit sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            x-show="open" x-cloak>
                            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">

                                    @foreach($langMap as $langKey => $lang)
                                        <a href="{{ route('change-locale', $langKey) }}"
                                           class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                                            @php
                                                $icon = "icons/{$lang}"
                                            @endphp
                                            @svg($icon, 'h-5 rounded-md')
                                            <div class="ml-4">
                                                <p class="text-base font-medium text-gray-900">{{ ucfirst($lang) }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </nav>
            <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                <a href="{{ route('login') }}"
                   old-class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                   class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary">  {{ __('general.login')}} </a>
                @if(false)
                    <a href="#"
                       class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary"> {{ __('general.register') }} </a>
                @endif
            </div>
        </div>
    </div>

    <div class="absolute top-0 inset-x-0 z-10 p-2 transition transform origin-top-right md:hidden" :class="{hidden: !showMenu}"
         x-transition:enter="transition duration-200 ease-out"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition duration-100 ease-in"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
            <div class="pt-5 pb-6 px-5">
                <div class="flex items-center justify-between">
                    <div>
                        @svg('logos/pluggamatte', 'h-14 fill-primary text-primary')
                    </div>
                    <div class="-mr-2">
                        <button type="button"
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
                        @click="() => showMenu = false">
                            <span class="sr-only">Close menu</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-6">
                    <nav class="grid gap-y-8">
                        @php
                            $menu = [
                              ['label' => __('general.home'), 'route' => route('pages', ['']), 'icon' => 'icons/hero-home'],
                              ['label' => __('general.about-us'), 'route' => route('pages', ['about-us']), 'icon' => 'icons/hero-user-group' ],
                              ['label' => __('general.contact'), 'route' => route('pages', ['contact']), 'icon' => 'icons/hero-phone'],
                            ]
                        @endphp

                        @foreach( $menu as $item )
                            <a href="{{ $item['route'] }}" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                @svg($item['icon'], 'h-6 text-primary')
                                <span class="ml-3 text-base font-medium text-gray-900"> {{ $item['label'] }} </span>
                            </a>
                        @endforeach


                    </nav>
                </div>
            </div>
            <div class="py-6 px-5 space-y-6 hidden">
                <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Pricing </a>

                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Docs </a>

                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Help Center </a>

                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Guides </a>

                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Events </a>

                    <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700"> Security </a>
                </div>
                <div>
                    <a href="#"
                       class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary"> {{ __('general.register') }}  </a>

                    <p class="mt-6 text-center text-base font-medium text-gray-500">
                        Existing user?
                        <a href="{{ route('login') }}"
                           class="text-primary hover:text-primary"> {{ __('general.login') }} </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

