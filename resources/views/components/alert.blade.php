<div>
    <div {{ $attributes->merge(['class' => $class]) }} role="alert">
        <span class="font-medium">{{ $title }}</span> {{ $slot }}
    </div>
</div>