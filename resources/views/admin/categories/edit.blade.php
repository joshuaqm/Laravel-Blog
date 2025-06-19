<x-layouts.app :title="__('Categorías')">
        <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.categories.index') }}">Categorías</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input name="name" label="Nombre de la categoría" value="{{ old('name', $category->name) }}"  placeholder="Ingrese el nombre de la categoría" />

            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="mt-4" variant="primary" color="sky">
                    Editar categoría
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
