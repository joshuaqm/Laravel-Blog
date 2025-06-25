<x-layouts.app :title="__('Prueba')">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" wire:navigate />
        <flux:breadcrumbs.item href="{{ route('prueba') }}" wire:navigate>Prueba</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <div class="py-12 max-w-4xl justify-center mx-auto">
        @persist('player')
            <audio src="{{asset('audios/piel.mp3')}}" controls></audio>
        @endpersist
    </div>
</x-layouts.app>
