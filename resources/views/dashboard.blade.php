<x-layouts.app :title="__('Dashboard')">
    {{-- <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div> --}}
    <div class="py-12 max-w-4xl justify-center mx-auto">

        {{-- <livewire:formulario lazy />

        <div class="mt-8">
            <livewire:comments />
        </div> --}}

        {{-- <livewire:father /> --}}

        <livewire:computed-component />



        {{-- @livewire('contador', [], key('contador-1'))
 
        @livewire('contador', [], key('contador-2'))

        @livewire('contador', [], key('contador-3')) --}}

        {{-- <livewire:contador :key="'contador-1'" />
        <livewire:contador :key="'contador-2'" /> --}}

    </div>
</x-layouts.app>
