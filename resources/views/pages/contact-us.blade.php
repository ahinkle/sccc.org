<x-layout.app>
    <x-slot name="seo">
        <title>Contact Us | Santa Claus Christian Church</title>
        <meta name="description" content="Contact us at Santa Claus Christian Church. We are here to serve you and help you grow in your relationship with Jesus.">
    </x-slot>

    <x-hero.page-hero>
       <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase">About SCCC</h1>
    </x-hero.page-hero>
    <div class="max-w-screen-xl mx-auto py-20">
        <x-cards.two-column-card>
            <div class="grid gap-y-10 px-5 self-center">
                <p class="font-poppins max-w-3xl">
                    Welcome to Santa Claus Christian Church! Whether you have questions, want to learn more, or simply want to say hello, we're here to listen and engage with you.
                </p>

                <div class="font-poppins max-w-3xl">
                    <h2 class="text-lg uppercase font-semibold">Service Times</h2>
                    <div class="pl-2">
                        <ol class="pt-2 pl-2">
                            <li>GROUNDED (Tranditional) Sunday - 9:00am</li>
                            <li>ROOTED (Youth) Wednesday - 6:00pm</li>
                        </ol>
                    </div>
                    <div class="pt-5">
                        <h2 class="text-lg uppercase font-semibold">Location</h2>
                        <div class="pl-2">
                            <ol class="pt-2 pl-2">
                                <li><a class="underline" href="https://goo.gl/maps/nivjbdc4zE58Ss4g6" target="_blank">351 N Holiday Blvd</a></li>
                                <li><a class="underline" href="https://goo.gl/maps/nivjbdc4zE58Ss4g6" target="_blank">Santa Claus, Indiana 47579</a></li>
                                <li class="pt-2">Phone: <a class="underline" href="tel:812-937-2938">(812) 937-2938</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="pt-5">
                        <h2 class="text-lg uppercase font-semibold">Office Hours</h2>
                        <ul class="pt-4 pl-2 grid gap-y-5">
                            <li>Monday - 8:00am to 3:30pm</li>
                            <li>Tuesday - 8:00am to 3:30pm</li>
                            <li>Wednesday - 9:00am to 5:00pm</li>
                            <li>Thursday - 8:00am to 3:30pm</li>
                            <li>Friday - 8:00am to 3:30pm</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('img/grounded/message-with-pastor-joseph.jpg') }}" alt="Current Message Series" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </div>
        </x-cards.two-column-card>
    </div>
</x-layout.app>
