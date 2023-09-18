@aware([
    'class' => 'inline-block px-8 py-5 bg-green-900 text-white uppercase font-poppins font-semibold tracking-wider text-base hover:bg-green-800 md:max-w-max text-center disabled:opacity-50 disabled:cursor-not-allowed',
])

@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => $class]) }}
        {{ $attributes }}
    >
        {{ $slot }}
    </a>
@endif

@if (! $href)
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
