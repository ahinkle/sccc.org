<x-cards.two-column-card>
    <div>
        <img src="{{ asset('img/series/living-out-gods-love.JPG') }}" alt="Current Message Series" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
    </div>
    <div class="xl:px-10 self-center grid gap-y-10">
        <h2 class="text-4xl font-poppins font-semibold uppercase">Living Out God's Love</h2>
        <h3 class="text-xl font-poppins font-semibold uppercase">Current Message Series</h3>
        <p class="text-base font-poppins">Discover how to cultivate compassion, kindness, and empathy as we navigate the challenges of our modern world. Through thought-provoking messages, heartfelt stories, and practical guidance, we aim to inspire you to deepen your connection with God's love and share it with others.</p>

        <x-inputs.button href="{{ route('messages.latest' )}}" target="_blank">Watch the latest message</x-inputs.button>
    </div>
</x-cards.two-column-card>
