@props([
    'width' => '7xl',
])

@php
    switch ($width) {
        case '7xl':
            $width = 'max-w-7xl ';
            break;
        case '4xl':
            $width = 'max-w-4xl ';
            break;
        default:
            $width = 'max-w-full ';
    }
@endphp

<div {{ $attributes->merge(['class' => $width . 'mx-auto px-4 sm:px-6 lg:px-8']) }}>
    {{ $slot }}
</div>