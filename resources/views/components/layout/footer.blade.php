<footer class="bg-white border-t border-gray-200 mt-10" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="mx-auto max-w-7xl px-6 pb-8 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8 pt-10">
            <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-gray-900 font-libre">About</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900 font-libre">Our Beliefs</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Staff</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Location & Times</a>
                            </li>
                            <li>
                                <a href="{{ route('events') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Events</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Careers</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Messages</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">View All Messages</a>
                            </li>
                            <li>
                                <a href="{{ route('livestream.sunday') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900"><x-fas-video class="mr-2 w-2.5 h-2.5 inline-block fill-gray-600 mb-0.5" />Sunday, 9 AM</a>
                            </li>
                            <li>
                                <a href="{{ route('livestream.wednesday') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900"><x-fas-video class="mr-2 w-2.5 h-2.5 inline-block fill-gray-600 mb-0.5" />Wednesday, 6 PM (Youth)</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Resources</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Member Directory</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Meetings & Minutes</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Give</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Contact</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact Us</a>
                            </li>
                            <li>
                                <a href="tel:812-948" class="text-sm leading-6 text-gray-600 hover:text-gray-900"><x-fas-phone class="mr-1 w-2.5 h-2.5 inline-block fill-gray-600" /> (812) 937-2938</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-10 xl:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-gray-900 font-libre">Subscribe to our newsletter: The Weekly Word</h3>
                <p class="mt-2 text-xs leading-6 text-gray-600 font-libre">The latest news, events, and happenings around the church, sent to your inbox weekly.</p>
                <livewire:newsletter.newsletter-footer-signup-form />
            </div>
        </div>
        <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
            <div class="flex space-x-6 md:order-2">
                <a href="https://www.facebook.com/SantaClausChristianChurch" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <x-fab-facebook class="h-6 w-6" />
                </a>
                <a href="https://www.instagram.com/santaclauschristianchurch/" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Instagram</span>
                    <x-fab-instagram class="h-6 w-6" />
                </a>
                <a href="https://x.com/sccc_org" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <x-fab-x-twitter class="h-6 w-6" />
                </a>
                <a href="https://www.youtube.com/SantaClausChristianChurch" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">YouTube</span>
                    <x-fab-youtube class="h-6 w-6" />
                </a>
            </div>
            <div>
                <p class="mt-8 text-xs leading-5 text-gray-500 md:order-1 md:mt-0">&copy; {{ date('Y') }} Santa Claus Christian Church. All rights reserved.</p>
                <p class="mt-8 text-xs leading-5 text-gray-500 md:order-1 md:mt-0">Web Design by <a href="https://grayloon.com" class="text-gray-500 hover:text-gray-600 underline">Andy Hinkle</a></p>
            </div>
        </div>
    </div>
</footer>
