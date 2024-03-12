<x-cards.two-column-card @class([$attributes->get('class')])>
    <div class="xl:px-10 self-center grid gap-y-10">
        <h2 class="text-4xl font-poppins font-semibold">About Santa Claus Christian Church</h2>
        <p class="text-base font-poppins">
            Welcome to Santa Claus Christian Church, formerly known as Santa Claus Methodist Church since our inception in 1849. Our rich history is intertwined
            with the Historic Santa Claus Campground, and our commitment to nurturing the faith of our youth has always been at the heart of our mission.
        </p>
        <x-inputs.button href="{{ route('about.what-we-believe' )}}">What We Believe</x-inputs.button>
    </div>
    <div>
        <img src="{{ asset('img/grounded/message-with-pastor-joseph.JPG') }}" alt="About Us" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
    </div>
</x-cards.two-column-card>
