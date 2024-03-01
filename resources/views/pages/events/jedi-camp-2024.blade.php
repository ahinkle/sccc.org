<x-layout.app>
    <x-slot name="seo">
        <title>Jedi Camp 2024 | Santa Claus Christian Church</title>
        <meta name="description" content="Jedi Camp 2024 is a summer camp for kids and teens, where they can learn about Jesus, make new friends, and have fun.">
    </x-slot>

    <x-hero.page-hero>
       <h1 class="text-3xl lg:text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase">Jedi Camp 2024: July 7th - July 12</h1>
    </x-hero.page-hero>
    
    <div class="max-w-screen-xl mx-auto py-20">
        <x-cards.two-column-card>
            <div class="grid gap-y-10 px-5 self-center order-2 lg:order-1">
                <p class="font-poppins max-w-3xl">
                    Jedi Camp is geared for both boys & girls who are going into grades 3 through 6. This year at Jedi Camp (Jedi Knight Training Academy) we 
                    are purposefully training and equipping our Jedi Younglings with God's personalized weaponry: <span class="font-bold">Prayer</span> 
                    So, to get into the spirit of our theme, our Younglings will have loads of fun with Star Wars games, themes and activities.
                </p>

                <p class="font-poppins max-w-3xl">
                    Dates: July 7 - July 12, 2024. The cost is $280 per camper. A $25 deposit is required on registration, with the balance due by June 24th. 
                    Pickup a registration form at the church office or <a href="#" class="text-green-500 underline">sign up here</a>. 
                    Payments may be made to: <span class="font-bold">Santa Claus Christian Church</span> with <span class="font-bold">Church Camp</span> in the memo line or made online by clicking the registration button below.
                </p>

                <p class="font-poppins max-w-3xl">
                    This spirited camp will be led by Sally Schaaf, Sydney Scherry & Area Pastors. The camp features all of the beloved traditions of Santa Claus Camping. 
                    Faith based lessons make the structure of a typical day, punctuated by crafts, swimming, archery, canoeing and of course, raising the roof of the 
                    Tabernacle in song! The day will begin and end in praise and worship.
                </p>

                <div class="grid grid-cols-1 gap-y-4 pb-10">
                    <x-inputs.button href="https://www.elexiogiving.com/App/Form/018757cc-091d-40b9-a8e6-00158a020fc7">Register Online</x-inputs.button>
                    <x-inputs.button href="{{ url('/downloads/2024/2024-mail-in-registration-printable.pdf') }}" target="_blank">Print Registration Form (Offline)</x-inputs.button>
                </div>
            </div>
            <div class="flex justify-center order-1 lg:order-2">
                <img src="{{ asset('img/events/jedi-elementary-camp.jpg') }}" alt="Jedi Elementary Camp" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </div>
        </x-cards.two-column-card>
        <x-cards.two-column-card>
            <a href="{{ url('/downloads/2024/2024-camper-forms.pdf') }}" target="_blank" class="flex justify-center">
                <img src="{{ asset('img/events/click-here-to-download-forms.jpg') }}" alt="Jedi Elementary Camp" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </a>
            <div class="grid gap-y-10 px-5 self-center">
                <p class="font-poppins max-w-3xl">
                        To ensure a smooth and enjoyable camp experience, we have compiled all the essential information into a comprehensive packet. This packet includes detailed instructions on check-in procedures, 
                        medical form requirements, camp rules, packing lists, and much more. It's vital for parents to review and complete necessary forms, especially regarding health and dietary information, 
                        to accommodate every camper's needs.
                </p>
                <p class="font-poppins max-w-3xl">
                        To start your preparation, we encourage you to download our detailed camp packet. It contains critical information such as the camp schedule, baptism details, closing celebration, 
                        registration instructions, and emergency contacts. You'll also find guidelines on what to bring (and what not to bring), along with information on camp meals, costs, and 
                        health insurance procedures.
                </p>
                <p class="font-poppins max-w-3xl">
                        Completing and returning the forms included in the packet is essential for a safe and organized camp experience. By being well-prepared, you can ensure that your camper has an 
                        incredible and memorable time at JEDI Camp
                </p>
                <x-inputs.button href="{{ url('/downloads/2024/2024-camper-forms.pdf') }}" target="_blank">Download Camper Forms</x-inputs.button>
            </div>
        </x-cards.two-column-card>
        <div class="text-center py-20 border-t mt-10">
            <h1 class="bg-gradient-to-r from-orange-700 via-orange-400 to-amber-300 inline-block text-transparent bg-clip-text text-4xl lg:text-5xl uppercase font-sans font-bold">Questions / Camp Contact</h1>
            <div class="grid grid-cols-1 gap-y-5 mt-10 justify-items-center">
                <p class="font-poppins max-w-3xl mx-auto">
                    If you have any questions about Jedi Camp, please feel free to contact our camp director, Sally Schaaf. 
                    You can reach her by phone or email, and she will be happy to assist you.
                </p>
                <p class="font-poppins">
                    Sally Schaaf, Camp Director
                </p>
                <p class="font-poppins">
                    <span class="font-semibold">Phone:</span> 765-434-1714
                </p>
                <p class="font-poppins">
                    <span class="font-semibold">Email:</span>
                    <a href="mailto:k.schaaf@sbcglobal.net" class="text-black underline">k.schaaf@sbcglobal.net</a>
                </p>
                <x-inputs.button href="{{ url('/downloads/2024/2024-jedi-flyer.pdf') }}" target="_blank">
                    Download Flyer
                </x-inputs.button>
            </p>
        </div>
    </div>
</x-layout.app>
