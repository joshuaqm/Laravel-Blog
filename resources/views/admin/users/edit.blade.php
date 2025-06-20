<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Users</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Edit</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <flux:input name="name" label="Nombre" value="{{ old('name', $user->name) }}"  placeholder="Ingrese el nombre del usuario" />
            <flux:input name="email" label="Correo" value="{{ old('email', $user->email) }}"  placeholder="Ingrese el correo del usuario" />

            <h1 class="text-lg font-bold">Permisos</h1>
            <div class="flex flex-col space-y-4">
                <table>
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Sección</th>
                            <th class="px-4 py-2">Lectura y Escritura</th>
                            <th class="px-4 py-2">Lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 text-center">Posts</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[posts][write]"
                                        {{ $user->permissions->contains('name', 'posts.write') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>                                
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[posts][read]"
                                        {{ $user->permissions->contains('name', 'posts.read') ? 'checked' : '' }} 
                                    >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-center">Categories</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[categories][write]"
                                        {{ $user->permissions->contains('name', 'categories.write') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>                                
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[categories][read]"
                                        {{ $user->permissions->contains('name', 'categories.read') ? 'checked' : '' }} 
                                    >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-center">Tags</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[tags][write]"
                                        {{ $user->permissions->contains('name', 'tags.write') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[tags][read]"
                                        {{ $user->permissions->contains('name', 'tags.read') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-center">Users</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[users][write]"
                                        {{ $user->permissions->contains('name', 'users.write') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <input type="checkbox"
                                        name="permissions[users][read]"
                                        {{ $user->permissions->contains('name', 'users.read') ? 'checked' : '' }}
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" class="mt-4 cursor-pointer" variant="primary" color="sky">
                    Crear usuario
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>