<div>
    <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mb-8">
        <form wire:submit.prevent="save" class="space-y-4">
            <div class="mb-4">
                <x-input class="w-full" label="Nombre" name="nombre" type="text" wire:model="title" autocomplete="off" />
            </div>
            
            <div class="mb-4">
                <x-input class="w-full" label="Resumen" name="excerpt" type="text" wire:model="excerpt" autocomplete="off" />
            </div>

            <div class="mb-4">
                <x-textarea class="w-full" label="Contenido" name="contenido" wire:model="content" >

                </x-textarea>
            </div>

            <div class="mb-4">
                <x-select class="w-full" label="Categoría" name="categoria" wire:model="category_id">
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
                            <x-checkbox label="{{ $tag->name }}" wire:model="selected_tags" value="{{ $tag->id }}" />
                        </li>
                    @endforeach
                </ul>
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
                <li>{{ $post->title }}</li>
            @endforeach

        </ul>
    </div>
</div>
