<x-layouts.app :title="__('Roles')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.roles.index') }}">Roles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <flux:input name="name" label="Nombre del rol" value="{{ old('name') }}"  placeholder="Ingrese el nombre del rol" />

            <div>
                <p class="text-sm font-medium my-4">Permisos</p>
                <div class="grid grid-cols-2 gap-4">
                    <ul>
                        @foreach ($permissions as $permission)
                            <li>
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-2"
                                        @checked(in_array($permission->id, old('permissions', [])))>
                                    <span class="ml-2">{{ $permission->name }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="mt-4" variant="primary" color="sky">
                    Crear rol
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
