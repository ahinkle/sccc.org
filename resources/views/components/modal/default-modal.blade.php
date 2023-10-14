@if ($show)
    <div x-data="{ 'showModal': true }" x-cloak>
        <div class="relative z-30" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="showModal">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div class="relative transform overflow-hidden rounded bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" x-on:click="showModal = false">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
                <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 uppercase font-poppins" id="modal-title">Tabbernacle This Weekend!</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-500">We are not at the main church building this weekend. <a class="underline text-green-900" href="https://sccc.org/events/tabernacle-sunday-service-oct-15-2023">We are at the tabbernacle</a> -- service starts at 10:00 AM with a meal at 11:15 AM. We hope to see you there!</p>
                    </div>
                </div>
                </div>
                <div class="mt-5 w-full">
                    <x-inputs.button class="md:max-w-full w-full" x-on:click="showModal = false">
                        Close
                    </x-inputs.button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endif
