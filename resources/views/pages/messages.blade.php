<x-layout.app>
    <x-slot name="seo">
        <title>Messages | Santa Claus Christian Church</title>
        <meta name="description" content="View our past messages and sermons from Santa Claus Christian Church.">
    </x-slot>

    <x-hero.page-hero bgUrl="{{ url('/img/headers/messages.jpg') }}">
       <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase">Messages</h1>
    </x-hero.page-hero>

    <div>
        <livewire:messages.message-list />
    </div>
</x-layout.app>
