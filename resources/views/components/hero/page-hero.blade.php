<div class="w-full bg-cover bg-center h-[450px]" style="background-image: url({{ $bgUrl ?? asset('img/headers/sccc-header.jpg') }})">
    <div class="max-w-screen-xl mx-auto flex items-center h-full px-5 xl:px-0 place-content-center lg:place-content-start">
        {{ $slot }}
    </div>
</div>
