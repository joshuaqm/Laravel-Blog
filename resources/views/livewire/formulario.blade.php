<div>
    <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mb-8">
        <form wire:submit.prevent="save" class="space-y-4">
            <div class="mb-4">
                <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model="title" 
                autocomplete="off" />
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="excerpt"
                    autocomplete="off" />
            </div>

            <div class="mb-4">
                <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="content">

                </x-textarea>
            </div>

            <div class="mb-4">
                <x-select class="w-full" label="Categoría" name="categoria" wire:model="category_id">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
                @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <ul class="space-y-2">
                    <label for="tags">Etiquetas</label>
                    @foreach ($tags as $tag)
                        <li>
                            <x-checkbox label="{{ $tag->name }}" wire:model="selected_tags"
                                value="{{ $tag->id }}" />
                        </li>
                    @endforeach
                </ul>
                @error('selected_tags') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <x-button type="submit">
                    Guardar
                </x-button>

            </div>
        </form>
    </div>
    <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700">
        <ul class="list-disc pl-6 space-y-2">
            @foreach ($posts as $post)
                <li class="flex justify-between" wire:key="post-{{ $post->id }}">
                    {{ $post->title }}

                    <div>
                        {{-- <x-button wire:click="edit({{ $post->id }})" class="ml-2" color="blue">
                            Editar
                        </x-button> --}}
                        <x-button wire:click="edit({{ $post->id }})" class="ml-2" color="blue">
                            Editar
                        </x-button>
                        <x-button wire:click="destroy({{ $post->id }})" class="ml-2" color="red">
                            Eliminar
                        </x-button>

                    </div>
                </li>
            @endforeach

        </ul>
    </div>

    @if ($open)
        <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto">

            <div class="bg-gray-800 opacity-25 fixed inset-0"></div>
            <div class="relative z-50 w-full max-w-4xl px-4 my-12">
                <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mx-auto w-full max-h-[90vh] overflow-y-auto">
                    <form wire:submit.prevent="update" class="space-y-4">
                        <div class="mb-4">
                            <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model="post_edit.title"
                                autocomplete="off" />
                        </div>

                        <div class="mb-4">
                            <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="post_edit.excerpt"
                                autocomplete="off" />
                        </div>

                        <div class="mb-4">
                            <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="post_edit.content">

                            </x-textarea>
                        </div>

                        <div class="mb-4">
                            <x-select class="w-full" label="Categoría" name="categoria" wire:model="post_edit.category_id">
                                <option value="" disabled>Seleccione una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <ul class="space-y-2">
                                <label for="tags">Etiquetas</label>
                                @foreach ($tags as $tag)
                                    <li>
                                        <x-checkbox label="{{ $tag->name }}" wire:model="post_edit.selected_tags"
                                            value="{{ $tag->id }}" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex justify-end">
                            <x-button wire:click="$set('open', false)" class="mr-2" color="gray">
                                Cancelar
                            </x-button>
                            <x-button type="submit">
                                Actualizar
                            </x-button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Actualizar Post
        </x-slot>

        <x-slot name="content">
            <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mx-auto w-full max-h-[90vh] overflow-y-auto">
                    <form wire:submit.prevent="update" class="space-y-4">
                        <div class="mb-4">
                            <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model="post_edit.title"
                                autocomplete="off" />
                        </div>

                        <div class="mb-4">
                            <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="post_edit.excerpt"
                                autocomplete="off" />
                        </div>

                        <div class="mb-4">
                            <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="post_edit.content">

                            </x-textarea>
                        </div>

                        <div class="mb-4">
                            <x-select class="w-full" label="Categoría" name="categoria" wire:model="post_edit.category_id">
                                <option value="" disabled>Seleccione una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <ul class="space-y-2">
                                <label for="tags">Etiquetas</label>
                                @foreach ($tags as $tag)
                                    <li>
                                        <x-checkbox label="{{ $tag->name }}" wire:model="post_edit.selected_tags"
                                            value="{{ $tag->id }}" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex justify-end">
                            <x-button wire:click="$set('open', false)" class="mr-2" color="gray">
                                Cancelar
                            </x-button>
                            <x-button type="submit">
                                Actualizar
                            </x-button>

                        </div>
                    </form>
                </div>
        </x-slot>

        <x-slot name="footer">
            
        </x-slot>
    </x-dialog-modal> --}}
    {{-- <flux:modal name="edit-profile.{{ $post->id }}" class="md:w-96">
        
    </flux:modal> --}}

    {{-- <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Actualizar Post
        </x-slot>

        <x-slot name="slot">
            <form wire:submit.prevent="update" class="space-y-4">
                <div class="mb-4">
                    <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model="post_edit.title"
                        autocomplete="off" />
                </div>

                <div class="mb-4">
                    <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="post_edit.excerpt"
                        autocomplete="off" />
                </div>

                <div class="mb-4">
                    <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="post_edit.content">

                    </x-textarea>
                </div>

                <div class="mb-4">
                    <x-select class="w-full" label="Categoría" name="categoria" wire:model="post_edit.category_id">
                        <option value="" disabled>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="mb-4">
                    <ul class="space-y-2">
                        <label for="tags">Etiquetas</label>
                        @foreach ($tags as $tag)
                            <li>
                                <x-checkbox label="{{ $tag->name }}" wire:model="post_edit.selected_tags"
                                    value="{{ $tag->id }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex justify-end">
                    <x-button wire:click="$set('open', false)" class="mr-2" color="gray">
                        Cancelar
                    </x-button>
                    <x-button type="submit">
                        Actualizar
                    </x-button>

                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('open', false)" color="gray">
                Cancelar
            </x-button>
        </x-slot>
    </x-dialog-modal> --}}

</div>
