<x-layout.app>
    <x-slot name="seo">
        <title>Events | Santa Claus Christian Church</title>
        <meta name="description" content="Join us for one of our upcoming events and happenings at Santa Claus Christian Church.">
    </x-slot>

    <x-hero.page-hero>
       <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase">Events</h1>
    </x-hero.page-hero>

    <div>
        <livewire:events.event-list />
    </div>
</x-layout.app>
