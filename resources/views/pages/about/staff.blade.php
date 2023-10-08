<x-layout.app>
    <x-slot name="seo">
        <title>Our Staff | Santa Claus Christian Church</title>
        <meta name="description" content="We are a group of people who love Jesus and love people. We are here to serve you and help you grow in your relationship with Jesus.">
    </x-slot>

    <x-hero.page-hero>
       <h1 class="text-5xl font-bold text-white font-sen border-b-4 pb-2 uppercase">Our Staff</h1>
    </x-hero.page-hero>
    <div class="max-w-screen-xl mx-auto py-20">
        <x-cards.two-column-card>
            <div class="grid gap-y-10 px-5 self-center order-2 lg:order-1">
                <p class="font-poppins max-w-3xl">
                    At Santa Claus Christian Church, we are more than just a team - we are a family united by our love for Jesus and our passion for serving people. Our diverse and dedicated staff members are here to support you on your spiritual journey and facilitate your growth in your relationship with Jesus Christ.
                </p>

                <p class="font-poppins max-w-3xl">
                    Each member of our staff brings unique gifts, talents, and experiences to our church community, allowing us to provide a wide range of services and resources to meet your needs. Whether you're seeking guidance, looking for a place to connect, or simply wanting to explore your faith, our staff is committed to walking alongside you every step of the way.
                </p>

                <p class="font-poppins max-w-3xl">
                    From pastors who provide insightful sermons and pastoral care, to administrative staff who ensure the smooth functioning of our church, to dedicated volunteers who lead various ministries and programs – we are all here to create an environment where you can experience God's love, find purpose, and develop meaningful connections with others who share your faith.
                </p>
            </div>
            <div class="flex justify-center order-1 lg:order-2">
                <img src="{{ asset('img/grounded/message-with-pastor-joseph.JPG') }}" alt="Current Message Series" class="w-full h-full object-cover max-w-lg xl:max-w-none xl:mx-auto">
            </div>
        </x-cards.two-column-card>
        <div class="pt-10">
            <x-staff.staff-listing-grid />
        </div>
    </div>
</x-layout.app>
