<div>
    {{-- <h1>{{ $name }}</h1> --}}
    <div>
        <x-input type="text" wire:model="name" />
        <x-button wire:click="save">
            Enviar
        </x-button>
    </div>
    <div>
        {{ $name }}
    </div>
</div>
