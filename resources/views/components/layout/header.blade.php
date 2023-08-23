<header class="px-2 py-3 flex items-center max-w-screen-2xl mx-auto" x-data="{ open: false }">
    <div class="w-1/2">
        <a href="{{ url('/') }}">
            <img src="{{ url('img/logo/SCCC_LOGO_FULL COLOR_NO BACKGROUND.png') }}" alt="Santa Claus Christian Church Logo" class="w-32 lg:w-40 xl:w-48 xl:ml-20 ml-2">
        </a>
    </div>

    <div class="w-1/2 flex xl:hidden justify-end">
        <div class="">
            <x-fas-bars class="w-8 h-8 text-black cursor-pointer xl:hidden" x-on:click="open = !open" />
        </div>
    </div>

    <nav class="w-1/2 hidden xl:grid xl:grid-flow-col xl:auto-cols-max gap-10 justify-center mx-auto font-poppins uppercase text-lg leading-10 tracking-wide">
        <x-layout.nav-item href='/' title="Home" />
        <x-layout.nav-item href='/' title="About">
            <x-layout.nav-item href='/about/what-we-believe' title="Our Beliefs" />
            <x-layout.nav-item href='/about/staff' title="Staff" />
            <x-layout.nav-item href='/' title="Location & Times" />
            <x-layout.nav-item href='/' title="Events & Calendar" />
            <x-layout.nav-item href='/' title="Careers" />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Messages" />
        <x-layout.nav-item href='/' title="Livestream" />
        <x-layout.nav-item href='/' title="Stay Updated">
            <x-layout.nav-item href='/' title="Weekly Newsletter" />
            <x-layout.nav-item href='/' title="Events" />
            <x-layout.nav-item href='/' title="Contact Us" />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Resources">
            <x-layout.nav-item href='/' title="Member Directory" />
            <x-layout.nav-item href='/' title="Meetings & Minutes" />
            <x-layout.nav-item href='/' title="Contact Us" />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Give" />
    </nav>
    <div class="w-1/4 hidden xl:flex">
        {{-- --}}
    </div>
</header>