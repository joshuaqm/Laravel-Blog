<x-layouts.app :title="__('Tags')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.tags.index') }}">Etiquetas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input name="name" label="Nombre de la etiqueta" value="{{ old('name', $tag->name) }}"  placeholder="Ingrese el nombre de la etiqueta" />

            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="mt-4" variant="primary" color="sky">
                    Editar etiqueta
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
