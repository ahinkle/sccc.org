<div class="xl:hidden" x-data="{ open: false }">
	<!-- Mobile Menu Logo/Button -->
	<div class="flex justify-between items-center px-2 py-4 bg-white border-b border-gray-200">
		<div class="w-1/2">
			<a href="{{ url('/') }}">
				<img src="{{ url('img/logo/SCCC_LOGO_FULL COLOR_NO BACKGROUND.png') }}" alt="Santa Claus Christian Church Logo" class="w-32 lg:w-40 xl:w-48 xl:ml-20 ml-2">
			</a>
		</div>

		<div class="w-1/2 flex justify-end">
			<div>
				<x-fas-bars class="w-8 h-8 text-green-900 cursor-pointer" x-show="!open" x-on:click="open = !open" />
				<x-fas-times class="w-8 h-8 text-green-900 cursor-pointer" x-show="open" x-cloak x-on:click="open = !open" />
			</div>
		</div>
    </div>

	<!-- Mobile Menu -->
	<nav class="space-y-5 px-5 pb-3 pt-6" x-cloak x-show="open" x-on:click.away="open = false"
		x-transition:enter="transition ease-out duration-200"
		x-transition:enter-start="opacity-0 transform scale-90"
		x-transition:enter-end="opacity-100 transform scale-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100 transform scale-100"
		x-transition:leave-end="opacity-0 transform scale-90"
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

		 <div class="border-t border-gray-900/10 pt-6 pb-8">
	 		<div class="flex justify-center">
				<a href="https://cfcnewbedford.org/" target="_blank" class="text-green-700 text-center text-sm underline font-poppins" rel="noopener noreferrer">
					Looking for CFC New Bedford (formerly sccc.org?)
				</a>
			</div>
            <div class="mt-6 flex space-x-10 md:order-2 justify-center">
                <a href="https://www.facebook.com/SantaClausChristianChurch" class="text-green-700">
                    <span class="sr-only">Facebook</span>
                    <x-fab-facebook class="h-8 w-8" />
                </a>
                <a href="https://www.instagram.com/santaclauschristianchurch/" class="text-green-700">
                    <span class="sr-only">Instagram</span>
                    <x-fab-instagram class="h-8 w-8" />
                </a>
                <a href="https://x.com/sccc_org" class="text-green-700">
                    <span class="sr-only">Twitter</span>
                    <x-fab-x-twitter class="h-8 w-8" />
                </a>
                <a href="https://www.youtube.com/SantaClausChristianChurch" class="text-green-700">
                    <span class="sr-only">YouTube</span>
                    <x-fab-youtube class="h-8 w-8" />
                </a>
            </div>
			<div class="flex justify-center mt-8">
				<a href="https://cfcnewbedford.org/" target="_blank" class="text-green-700 text-center text-sm font-poppins" rel="noopener noreferrer">
					<x-fas-phone class="inline-block w-4 h-4 mr-1" /> <span class="underline">812-937-2938</span>
				</a>
			</div>
	</nav>
</div>
