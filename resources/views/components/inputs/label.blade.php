<label for="{{ $for }}" @class([
    'text-black pb-5 uppercase text-sm' => ! $hideLabel,
    'sr-only' => $hideLabel
])>
    {{ $slot }}
</label>
