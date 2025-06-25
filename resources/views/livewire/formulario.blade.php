<div>
    <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mb-8">
        @if ($postCreate->image)
            <div class="mb-4">
                <img src="{{ $postCreate->image->temporaryUrl() }}" alt="">
            </div>
        @endif


        <form wire:submit.prevent="save" class="space-y-4">
            <div class="mb-4">
                <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model.live="postCreate.title"
                    autocomplete="off" />
                @error('postCreate.title')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="postCreate.excerpt"
                    autocomplete="off" />
                @error('postCreate.excerpt')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="postCreate.content">

                </x-textarea>
            </div>

            <div class="mb-4">
                <x-select class="w-full" label="Categoría" name="categoria" wire:model.live="postCreate.category_id">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
                @error('postCreate.category_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <div x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <input class="w-full border-2 p-2" label="Imagen" name="image" type="file"
                        wire:model.live="postCreate.image" accept="image/*"
                        @change="progress = 0" />

                    <div x-show="uploading" class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                            <div class="bg-blue-500 h-4 rounded-full transition-all duration-300"
                                :style="'width: ' + progress + '%'"></div>
                        </div>
                        <div class="text-xs text-gray-600 mt-1 text-right" x-text="progress + '%'"></div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <ul class="space-y-2">
                    <label for="tags">Etiquetas</label>
                    @foreach ($tags as $tag)
                        <li>
                            <x-checkbox label="{{ $tag->name }}" wire:model="postCreate.selected_tags"
                                value="{{ $tag->id }}" />
                        </li>
                    @endforeach
                </ul>
                @error('postCreate.selected_tags')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-button wire:loading.class="!opacity-50 cursor-not-allowed" type="submit">
                    Guardar
                </x-button>

            </div>
        </form>

        <div wire:loading.delay wire:target="save">
            Procesando... 
        </div>
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
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

    @if ($postEdit->open)
        <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto">

            <div class="bg-gray-800 opacity-25 fixed inset-0"></div>
            <div class="relative z-50 w-full max-w-4xl px-4 my-12">
                <div
                    class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mx-auto w-full max-h-[90vh] overflow-y-auto">
                    <form wire:submit.prevent="update" class="space-y-4">
                        <div class="mb-4">
                            <x-input class="w-full" label="Nombre" name="nombre" type="text"
                                wire:model.live="postEdit.title" autocomplete="off" />
                            @error('postEdit.title')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input class="w-full" label="Resumen" name="excerpt" type="text"
                                wire:model.live="postEdit.excerpt" autocomplete="off" />
                            @error('postEdit.excerpt')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-textarea class="w-full" label="Contenido" name="contenido"
                                wire:model.live="postEdit.content">

                            </x-textarea>
                            @error('postEdit.content')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-select class="w-full" label="Categoría" name="categoria"
                                wire:model.live="postEdit.category_id">
                                <option value="" disabled>Seleccione una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                            @error('postEdit.category_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input class="w-full" label="Slug" name="slug" type="text"
                                wire:model.live="postEdit.slug" autocomplete="off" />
                            @error('postEdit.slug')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <ul class="space-y-2">
                                <label for="tags">Etiquetas</label>
                                @foreach ($tags as $tag)
                                    <li>
                                        <x-checkbox label="{{ $tag->name }}" wire:model="postEdit.selected_tags"
                                            value="{{ $tag->id }}" />
                                    </li>
                                @endforeach
                                @error('postEdit.selected_tags')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </ul>
                        </div>

                        <div class="flex justify-end">
                            <x-button wire:click="$set('postEdit.open', false)" class="mr-2" color="gray">
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
    @push('xd')
        <script>
            Livewire.on('post-created', function(comment) {
                // Aquí puedes manejar la lógica después de que se haya creado un post
                console.log(comment);
            });
        </script>
    @endpush
</div>
