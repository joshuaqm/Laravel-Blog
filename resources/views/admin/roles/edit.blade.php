<x-layouts.app :title="__('Roles')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.roles.index') }}">Roles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Editar</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <flux:input name="name" label="Nombre del rol" value="{{ old('name', $role->name) }}"
                placeholder="Ingrese el nombre del rol" />
                <ul>

                    @foreach ($permissions as $permission)
                    <li>
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-2"
                            @checked(in_array($permission->id, old('permissions', $rolePermissions)))>
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            <div class="flex justify-end mt-4">
                <flux:button type="submit" class="mt-4" variant="primary" color="sky">
                    Editar rol
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
