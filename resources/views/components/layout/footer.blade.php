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
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900 font-libre">Marketing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Analytics</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Commerce</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Insights</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Pricing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Documentation</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Guides</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">API Status</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Company</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Jobs</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Partners</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Claim</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-10 xl:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-gray-900 font-libre">Subscribe to our newsletter: The Weekly Word</h3>
                <p class="mt-2 text-xs leading-6 text-gray-600 font-libre">The latest news, events, and happenings around the church, sent to your inbox weekly.</p>
                <form class="mt-6 grid gap-y-3">
                    <x-inputs.input
                        name="name"
                        label="Enter your name"
                        hideLabel
                        required
                    />
                    <x-inputs.input
                        type="email"
                        name="email"
                        label="Enter your e mail address"
                        hideLabel
                        required
                    />
                    <x-inputs.button type="submit" class="md:max-w-none">
                        <x-fas-envelope class="mr-1 w-4 h-4 inline-block" />
                        Subscribe
                    </x-inputs.button>
                </form>
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
