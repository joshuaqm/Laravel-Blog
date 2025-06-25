<div>
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
