 <div>
    <label for="{{ $name }}" @class(['sr-only' => $hideLabel])>
        {{ $label }} @if ($attributes->has('required')) <span>*</span> @endif
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $attributes }}
        @class([
            'w-full min-w-0 appearance-none border-0 bg-white px-3 py-4 text-base text-gray-900 shadow-sm ring-1 ring-inset
            ring-black placeholder:text-gray-400 sm:text-sm sm:leading-6',
            'ring-red-500' => $errors->has($name),
            $class,
        ])
    />
</div>
