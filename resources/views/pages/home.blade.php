@extends('layouts.front')

@section('content')

    <main class="lg:relative">
        <div class="mx-auto _max-w-7xl w-full pt-16 pb-20 text-center lg:py-12 lg:text-left">
            <div class="px-4 lg:w-1/2 sm:px-8 xl:pr-16">
                <h1
                    class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                    <span class="block xl:inline">Plugga matte med</span>
                    <span class="block text-primary xl:inline">tidsfördelad repetition</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-lg text-gray-500 sm:text-xl md:mt-5 md:max-w-3xl">Det
                    digitala hjälpmedlet för att studera matematik på gymnasienivå med tidsfördelad repetition <br>(spaced repetition).</p>
                <div class="mt-10 sm:flex sm:justify-center lg:justify-start">
                    @if(false)
                        <div class="rounded-md shadow">
                            <a href="/about-us"
                               class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary md:py-4 md:text-lg md:px-10">
                                Läs mer
                            </a>
                        </div>
                    @endif
                    @if(false)
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                            <a href="#"
                               class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                Live demo</a>
                        </div>
                    @endif
                </div>
                @if(false)
                    <div class="w-full flex flex-col md:items-start items-center justify-center gap-2">
                        <div class="flex flex-col items-center">
                            <h1
                                class="text-2xl tracking-tight font-extrabold text-gray-900 sm:text-2xl md:text-3xl lg:text-2xl xl:text-3xl">
                                <span class="block xl:inline">pluggamatte.se på 2 minuter</span>
                            </h1>
                            <video class="border-[3px] border-primary rounded-md" width="400" controls>
                                <source src="video/video7MB.mp4" type="video/mp4">
                                Your browser does not support HTML video.
                            </video>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="relative w-full h-64 sm:h-72 md:h-96 lg:h-full lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:h-full">
            <img class="absolute inset-0 w-full h-full object-cover"
                 src="https://images.unsplash.com/photo-1596496050755-c923e73e42e1?ixlib=rb-1.2.1&raw_url=true&q=80&fm=jpg&crop=entropy&cs=tinysrgb&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1453"
                 alt="">
        </div>
    </main>

    @if(false)
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">All-in-one platform</h2>
                    <p class="mt-4 text-lg text-gray-500">Ac euismod vel sit maecenas id pellentesque eu sed
                        consectetur.
                        Malesuada adipiscing sagittis vel nulla nec.</p>
                </div>
                <dl
                    class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">
                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Invite team members</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Tempor tellus in aliquet eu et sit nulla tellus.
                            Suspendisse est, molestie blandit quis ac. Lacus.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Notifications</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Ornare donec rhoncus vitae nisl velit, neque,
                            mauris
                            dictum duis. Nibh urna non parturient.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">List view</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Etiam cras augue ornare pretium sit malesuada
                            morbi orci,
                            venenatis. Dictum lacus.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Boards</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Interdum quam pulvinar turpis tortor, egestas quis
                            diam
                            amet, natoque. Mauris sagittis.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Keyboard shortcuts</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Ullamcorper in ipsum ac feugiat. Senectus at
                            aliquam
                            vulputate mollis nec. In at risus odio.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Reporting</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Magna a vel sagittis aliquam eu amet. Et lorem
                            auctor quam
                            nunc odio. Sed bibendum.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Calendars</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Sed mi, dapibus turpis orci posuere integer. A
                            porta
                            viverra posuere adipiscing turpis.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <!-- Heroicon name: outline/check -->
                            <svg class="absolute h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Mobile app</p>
                        </dt>
                        <dd class="mt-2 ml-9 text-base text-gray-500">Quisque sapien nunc nisl eros. Facilisis sagittis
                            maecenas
                            id dignissim tristique proin sed.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center">
                <div class="lg:w-0 lg:flex-1">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl" id="newsletter-headline">
                        Sign up
                        for our newsletter</h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-gray-300">Anim aute id magna aliqua ad ad non
                        deserunt sunt.
                        Qui irure qui Lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat.</p>
                </div>
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email-address" type="email" autocomplete="email" required
                               class="w-full px-5 py-3 border border-transparent placeholder-gray-500 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white focus:border-white sm:max-w-xs rounded-md"
                               placeholder="Enter your email">
                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit"
                                    class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Notify
                                me
                            </button>
                        </div>
                    </form>
                    <p class="mt-3 text-sm text-gray-300">
                        We care about the protection of your data. Read our
                        <a href="#" class="text-white font-medium underline"> Privacy Policy. </a>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endsection
