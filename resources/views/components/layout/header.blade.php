<header class="px-2 py-3 flex items-center max-w-screen-2xl mx-auto relative" x-data="{ open: false }">
    <div class="w-1/2">
        <a href="{{ url('/') }}">
            <img src="{{ url('img/logo/SCCC_LOGO_FULL COLOR_NO BACKGROUND.png') }}" alt="Santa Claus Christian Church Logo" class="w-32 lg:w-40 xl:w-48 xl:ml-20 ml-2">
        </a>
    </div>

    <div class="w-1/2 flex xl:hidden justify-end">
        <div class="">
            <x-fas-bars class="w-8 h-8 text-black cursor-pointer xl:hidden" x-show="!open" x-on:click="open = !open" />
            <x-fas-times class="w-8 h-8 text-black cursor-pointer xl:hidden" x-show="open" x-on:click="open = !open" />
        </div>
    </div>

    <nav class="hidden w-1/2 static xl:grid grid-flow-col auto-cols-max gap-10 justify-center mx-auto font-poppins uppercase text-lg leading-10 tracking-wide"
        {{-- x-show="open" x-on:click.away="open = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" --}}
    >
        <x-layout.nav-item href='/' title="Home" />
        <x-layout.nav-item href='/' title="About">
            <x-layout.nav-item href='/about/what-we-believe' title="Our Beliefs" preventUnderline />
            <x-layout.nav-item href='/about/staff' title="Staff" preventUnderline />
            <x-layout.nav-item href='/contact-us' title="Location & Times" preventUnderline />
            <x-layout.nav-item href='/events' title="Events & Calendar" preventUnderline />
        </x-layout.nav-item>
        <x-layout.nav-item href='/messages' title="Messages" />
        <x-layout.nav-item href='/livestream' title="Livestream" />
        <x-layout.nav-item href='/' title="Stay Updated">
            <x-layout.nav-item href='/' title="Weekly Newsletter" preventUnderline />
            <x-layout.nav-item href='/events' title="Events" preventUnderline />
            <x-layout.nav-item href='/contact-us' title="Contact Us" preventUnderline />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Resources">
            <x-layout.nav-item href='/' title="Member Directory" preventUnderline />
            <x-layout.nav-item href='/resources/meetings-and-minutes' title="Meetings & Minutes" preventUnderline />
            <x-layout.nav-item href='/contact-us' title="Contact Us" preventUnderline />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Give" />
    </nav>
    <div class="w-1/4 hidden xl:flex">
        {{-- --}}
    </div>
</header>
