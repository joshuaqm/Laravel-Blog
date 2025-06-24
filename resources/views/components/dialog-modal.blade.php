<div 
    x-data="{ open: @entangle($attributes->wire('model')) }" 
    x-show="open" 
    class="fixed inset-0 flex items-center justify-center z-50"
    style="display: none;"
>
    <div class="fixed inset-0 bg-gray-900 opacity-50"></div>
    <div 
        class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 z-10"
        @click.away="open = false"
        @keydown.escape.window="open = false"
    >
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">
                {{ $title ?? '' }}
            </h2>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                &times;
            </button>
        </div>
        <div>
            {{ $slot }}
        </div>
        @if(isset($footer))
            <div class="mt-4">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>