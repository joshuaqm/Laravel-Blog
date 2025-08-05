<x-layouts.app :title="__('Permisos')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.permissions.index') }}">Permisos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <flux:input name="name" label="Nombre del permiso" value="{{ old('name') }}"  placeholder="Ingrese el nombre del permiso" />

            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="mt-4" variant="primary" color="sky">
                    Crear permiso
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>