<div>
    @livewire('hijo')

    <x-button class="mb-4" wire:click="$set('count', 0)">
        Resetear
    </x-button>

    <x-button class="mb-4" wire:click="$toggle('open')">
        Mostrar/ocultar
    </x-button>

    <form class="mb-4" wire:submit="save">
        <x-input
            type="text" 
            wire:model.defer="pais" 
            placeholder="Agregar nuevo país" 
            wire:keydown="increment"
            autocomplete="off"
            />

        <x-button type="submit">
            Agregar
        </x-button>
    </form>
    @if($open)
        <ul class="list-disc list-inside">
            @foreach ($paises as $index => $pais)
                <li wire:key="pais-{{ $index }}" class="flex items-center mb-2">
                    <span wire:mouseenter="changeActive('{{ $pais }}')" class="font-bold">
                        ({{$index}}) {{ $pais }}
                    </span> 

                    <x-button wire:click="delete({{$index }})" class="ml-2" color="red">
                        X
                    </x-button>

                </li>
            @endforeach
        </ul>
    @endif


    {{ $active }}

    {{ $count }}
</div>
