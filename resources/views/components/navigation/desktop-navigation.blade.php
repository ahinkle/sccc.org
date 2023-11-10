<div class="hidden px-2 py-3 xl:flex items-center max-w-screen-2xl mx-auto relative">
    <div class="w-1/2">
        <a href="{{ url('/') }}">
            <img src="{{ url('img/logo/SCCC_LOGO_FULL COLOR_NO BACKGROUND.png') }}" alt="Santa Claus Christian Church Logo" class="w-32 lg:w-40 xl:w-48 xl:ml-20 ml-2">
        </a>
    </div>

    <nav class="w-1/2 static grid grid-flow-col auto-cols-max gap-10 justify-center mx-auto font-poppins uppercase text-lg leading-10 tracking-wide">
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
            <x-layout.nav-item href='/events' title="Events" preventUnderline />
            <x-layout.nav-item href='/contact-us' title="Contact Us" preventUnderline />
        </x-layout.nav-item>
        <x-layout.nav-item href='/' title="Resources">
            <x-layout.nav-item href='/contact-us' title="Contact Us" preventUnderline />
            <x-layout.nav-item href='https://santaclauscc.elexiochms.com/user/login' title="Elexio Login" preventUnderline />
        </x-layout.nav-item>
        <x-layout.nav-item href='https://www.elexiogiving.com/App/Form/de761f23-9f10-4013-bb2a-9b73c870cb10' title="Give" />
    </nav>
    <div class="w-1/4 flex">
        {{-- --}}
    </div>
</div>
