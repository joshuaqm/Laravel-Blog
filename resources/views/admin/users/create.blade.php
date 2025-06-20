<x-layouts.app :title="__('Posts')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Users</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <flux:input name="name" label="Nombre" value="{{ old('name') }}"  placeholder="Ingrese el nombre del usuario" />
            <flux:input name="email" label="Correo" value="{{ old('email') }}"  placeholder="Ingrese el correo del usuario" />
            <flux:input name="password" type="password" value="{{ old('password') }}" label="Contraseña" placeholder="Ingrese la contraseña del usuario" />

            <h1 class="text-lg font-bold">Permisos</h1>
            <div class="flex flex-col space-y-4">
                <table>
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Sección</th>
                            <th class="px-4 py-2">Acceso</th>
                            <th class="px-4 py-2">Lectura y Escritura</th>
                            <th class="px-4 py-2">Lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 text-center">Posts</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[posts][access]" value="1" />
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[posts][write]" value="1" />
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[posts][read]" value="1" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-center">Categories</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[categories][access]" value="1" />
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[categories][write]" value="1" />
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center">
                                    <flux:checkbox name="permissions[categories][read]" value="1" />
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
