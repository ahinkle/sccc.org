<x-cards.two-column-card>
    <div class="order-2 lg:order-1">
        <img src="{{ asset('img/grounded/message.JPG') }}" alt="Grounded: Traditonal Worship" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
    </div>
    <div class="xl:px-10 self-center grid gap-y-10">
        <h2 class="text-4xl font-poppins font-semibold uppercase">GROUNDED: Traditional Worship</h2>
        <h3 class="text-xl font-poppins font-semibold uppercase">Sunday 9:00 AM</h3>
        <p class="text-base font-poppins">
            We extend a warm invitation to join us at Santa Claus Christian Church! Whether you're a long-time believer or just curious to learn more about Jesus Christ, we welcome you to our traditonal worship service where we sing hymns, pray, and hear a message from our pastor.
            Come experience the love and teachings of Jesus Christ with us. Our doors are open, and we look forward to sharing our faith journey with you.
        </p>

        <x-inputs.button href="{{ route('messages.latest' )}}" target="_blank">Watch the latest message</x-inputs.button>
    </div>
</x-cards.two-column-card>
