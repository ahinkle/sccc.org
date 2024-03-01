<x-layout.app>
    <x-slot name="seo">
        <title>Church in Santa Claus, Indiana | Santa Claus Christian Church</title>
        <meta name="description" content="Welcome to Santa Claus Christian Church (Formerly Santa Claus Methodist Church), where faith, fellowship, and love come together. Join us on a journey of spiritual growth and connection as we embrace the love of Jesus Christ.">
    </x-slot>

    <div class="home-hero relative h-[calc(100vh-20rem)] min-h-[38rem]">
        <div class="flex max-w-screen-xl mx-auto h-full items-center justify-center xl:justify-start">
            <div class="flex flex-wrap px-5 text-white -mt-28 text-center xl:text-left">
                <h1 class="w-full pt-5 text-xl md:text-2xl xl:text-4xl font-libre uppercase">
                    <span class="block py-4">A Community</span>
                    <span class="block py-4">Rooted In Christ</span>
                    <span class="block py-4">Grounded By Faith</span>
                    <span class="block py-4">And Branching Out In Love</span>
                </h1>

                <hr class="w-1/2 my-5 border border-white mx-auto xl:mx-0 opacity-25 xl:hidden">

                <h2 class="w-full pt-2 text-xs sm:text-sm font-libre">
                    <span class="block xl:inline-block">Sunday, 9:00 AM</span>
                    <span class="px-2 hidden xl:inline-block">&#x2022;</span>
                    <hr class="w-1/12 my-1 border border-white mx-auto xl:mx-0 opacity-25 xl:hidden">
                    <span class="block xl:inline-block">Wednesday, 6:00 PM (Youth)</span>
                </h2>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto grid px-2 xl:px-0 -mt-[135px]">
        <div class="grid lg:grid-cols-3 grid-cols-1 gap-2 xl:gap-4 text-center z-20">
            <a class="bg-sand-200 border border-black p-24 hover:cursor-pointer group hover:border-green-900 hover:shadow bg-cover bg-top lg:bg-center bg-no-repeat"
                style="background-image: url('{{ asset('img/events/youth-group.JPG') }}');"
                href="{{ route('contact-us') }}"
            >
                <h2 class="text-white uppercase text-3xl md:text-4xl font-poppins tracking-wide mt-3.5 group-hover:scale-105 transition-all duration-300">
                    New Here?
                </h2>
            </a>
            <a class="bg-sand-200 border border-black p-24 hover:cursor-pointer group hover:border-green-900 hover:shadow bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('img/livestream/soundboard.jpg') }}');"
                href="{{ route('livestream.index') }}"
                target="_blank" rel="noopener noreferrer"
            >
                <h2 class="text-white uppercase text-3xl md:text-4xl font-poppins tracking-wide mt-3.5 group-hover:scale-105 transition-all duration-300 inline-flex items-center">
                    <x-fas-video class="w-5 h-5 mr-2 inline-block text-red-500" />
                    Livestream
                </h2>
                @if (
                    now()->isSunday() && now()->hour >= 9 && now()->hour <= 10
                    || now()->isWednesday() && now()->hour >= 18 && now()->hour <= 19
                )
                    <span class="text-red-500 text-sm ml-2 block uppercase tracking-widest">
                        Live Now!
                    </span>
                @endif
            </a>
            <a class="bg-sand-200 border border-black p-24 hover:cursor-pointer group hover:border-green-900 hover:shadow bg-cover bg-top lg:bg-center bg-no-repeat"
                style="background-image: url('{{ asset('img/fmsc/santa-claus-indiana-feed-my-starving-children-event.jpg') }}');"
                href="{{ route('events.index') }}"
            >
                <h2 class="text-white uppercase text-3xl md:text-4xl font-poppins tracking-wide mt-3.5 group-hover:scale-105 transition-all duration-300">
                    Events
                </h2>
            </a>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto pt-20">
        <x-cards.two-column-card>
            <div class="xl:px-10 self-center grid gap-y-10 order-2 xl:order-1 xl:py-24 xl:pt-8">
                <h2 class="text-4xl font-poppins font-semibold">Silent Retreat</h2>
                <h3 class="text-xl font-poppins font-semibold uppercase">March 14th, 8:00 AM - 3:00 PM</h3>
                <p class="text-base font-poppins">Pause. Rest.  Think of God's love. Breathe.  Give yourself time to notice your body rising and falling with the gift of breath, and life. In the brief time you took to read these few short suggestions, chances are you became more aware of yourself and God.  Maybe even connecting a little deeper...with a little more peace.  That peace with and connection to our good God is our hope for all who join us on the upcoming Silent Retreat at the Historic Santa Claus Campground. </p>

                <x-inputs.button href="{{ route('events.silentretreat') }}">Register Now</x-inputs.button>
            </div>
            <div class="order-1 xl:order-2">
                <img src="{{ asset('img/events/silent-retreat.jpeg') }}" alt="Silent Retreat" class="w-full h-full max-h-[600px] object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </div>
        </x-cards.two-column-card>
        <x-cards.two-column-card>
            <div>
                <img src="{{ asset('img/events/jedi-elementary-camp.jpg') }}" alt="Jedi Elementary Camp" class="w-full h-full max-h-[600px] object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </div>
            <div class="xl:px-10 self-center grid gap-y-10 xl:py-24 xl:pt-8">
                <h2 class="text-4xl font-poppins font-semibold">Jedi Elementary Church Camp</h2>
                <h3 class="text-xl font-poppins font-semibold uppercase">July 7th - July 12th</h3>
                <p class="text-base font-poppins">Jedi Camp is geared for both boys & girls who are going into grades 3 through 6. This year at Jedi Camp (Jedi Knight Training Academy) we are purposefully training and equipping our Jedi Younglings with God's personalized weaponry: Prayer</p>
                <p class="text-base font-poppins">So, to get into the spirit of our theme, our Younglings will have loads of fun with Star Wars games, themes and activities.</p>

                <x-inputs.button href="{{ route('events.jedi-camp') }}">Register Now</x-inputs.button>
            </div>
        </x-cards.two-column-card>
        <x-cards.current-message-series />
        {{-- <x-cards.rooted /> --}}
        <x-cards.about-us-cta />
        <x-events.upcoming-events-slider />
    </div>
</x-layout.app>
