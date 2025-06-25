<div>
    @persist('player')
        <audio src="{{asset('audios/piel.mp3')}}" controls></audio>
    @endpersist
    <x-button wire:click="redirigir">
        Ir a prueba
    </x-button>
    <h1 class="text-2xl font-bold">
        Soy el componente padre
    </h1>

    <x-input wire:model.live="name"></x-input>
    <hr class="my-4">


    <div>
        {{-- Sintaxis direccional padre hijo --}}
        {{-- @livewire('children', [
            'name' => $name
        ]) --}}

        {{-- Sintaxis bidireccional --}}
        <livewire:children wire:model="name" />
    </div>
</div>
