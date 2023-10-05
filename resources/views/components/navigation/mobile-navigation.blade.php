<div class="xl:hidden" x-data="{ open: false }">
	<!-- Mobile Menu Logo/Button -->
	<div class="flex justify-between items-center px-2 py-2 bg-white border-b border-gray-200">
		<div class="w-1/2">
			<a href="{{ url('/') }}">
				<img src="{{ url('img/logo/SCCC_LOGO_FULL COLOR_NO BACKGROUND.png') }}" alt="Santa Claus Christian Church Logo" class="w-32 lg:w-40 xl:w-48 xl:ml-20 ml-2">
			</a>
		</div>

		<div class="w-1/2 flex justify-end">
			<div>
				<x-fas-bars class="w-8 h-8 text-black cursor-pointer" x-show="!open" x-on:click="open = !open" />
				<x-fas-times class="w-8 h-8 text-black cursor-pointer" x-show="open" x-cloak x-on:click="open = !open" />
			</div>
		</div>
    </div>

	<!-- Mobile Menu -->
	<nav class="space-y-5 px-2 pb-3 pt-2" x-cloak x-show="open" x-on:click.away="open = false">
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
	</nav>
</div>
