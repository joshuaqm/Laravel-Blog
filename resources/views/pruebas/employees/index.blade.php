<x-layouts.app :title="__('Empleados')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('test.empleados.index') }}">Empleados</flux:breadcrumbs.item>
            
        </flux:breadcrumbs>

        <a href="{{ route('test.empleados.create') }}" class="btn btn-blue">Agregar empleado</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre completo
                    </th>
                    <th scope="col" class="px-6 py-3" >
                        Iniciales
                    </th>
                    <th scope="col" class="px-6 py-3" width="10px">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $employee->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $employee->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->initials }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('test.empleados.edit', $employee) }}" class="btn btn-blue text-xs">
                                    Editar
                                </a>
                                <form class="delete-form" action="{{ route('test.empleados.destroy', $employee) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red text-xs">
                                        Eliminar
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pt-10">
            {{ $employees->links() }}
        </div>
    </div>
    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-form');

            forms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: "¿Estás seguro?",
                        text: "¡No podrás revertir esto!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, ¡elimínalo!",
                        cancelButtonText: "No, ¡cancelar!",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelado",
                                text: "Tu archivo imaginario está a salvo :)",
                                icon: "error"
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>