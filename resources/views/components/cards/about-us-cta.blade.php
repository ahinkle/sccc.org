<x-cards.two-column-card @class([$attributes->get('class')])>
    <div>
        <img src="{{ asset('img/grounded/message.JPG') }}" alt="About Us" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
    </div>
    <div class="xl:px-10 self-center grid gap-y-10">
        <h2 class="text-4xl font-poppins font-semibold">About Santa Claus Christian Church</h2>
        <p class="text-base font-poppins">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>

        <x-inputs.button href="#">What We Believe</x-inputs.button>
    </div>
</x-cards.two-column-card>
