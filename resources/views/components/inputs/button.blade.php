{{-- Create a href link and make it appear as a button. --}}
@php
    $class = 'inline-block px-8 py-5 bg-green-900 text-white uppercase font-poppins font-semibold tracking-wider text-base hover:bg-green-800 md:max-w-max text-center '.($attributes->get('class') ?? '');
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $class }}">{{ $slot }}</a>
@endif
