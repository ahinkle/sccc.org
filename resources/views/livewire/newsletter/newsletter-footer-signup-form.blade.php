<div class="mt-6">
    @if ($showVerifyEmailMessage)
        <p class="mt-2 text-base leading-6 text-white p-4 font-libre bg-green-700 rounded font-semibold">
            Please check your email and click the link we sent you to confirm your subscription.
            <span class="block pt-2">If you don't see the email, check your spam folder.</span>
        </p>
    @else
        <form class="grid gap-y-3" wire:submit="subscribe">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <x-inputs.input
                name="name"
                label="Enter your name"
                wire:model="name"
                hideLabel
                required
            />
            <x-inputs.input
                type="email"
                name="email"
                wire:model="email"
                label="Enter your e mail address"
                hideLabel
                required
            />
            <x-inputs.button type="submit" class="md:max-w-none" wire:loading.attr="disabled">
                <x-fas-envelope class="mr-1 w-4 h-4 inline-block" />
                Subscribe
            </x-inputs.button>
        </form>
    @endif
</div>
