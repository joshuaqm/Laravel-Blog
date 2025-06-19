<x-layouts.app :title="__('Posts')">
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Nuevo</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
            @csrf
            <flux:input name="title" oninput="string_to_slug(this.value, '#slug')" label="Título del post" value="{{ old('title') }}"  placeholder="Ingrese el título del post" />
            <flux:input name="slug" id="slug" label="Slug del post" value="{{ old('slug') }}"  placeholder="Ingrese el slug del post" />
            {{-- <flux:input name="excerpt" label="Extracto del post" value="{{ old('excerpt') }}"  placeholder="Ingrese el extracto del post" />
            <flux:input name="content" label="Contenido del post" value="{{ old('content') }}"  placeholder="Ingrese el contenido del post" /> --}}
            <flux:select name="category_id" label="Categoría" placeholder="Seleccione una categoría...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}">
                        {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end">
                <flux:button type="submit" class="mt-4 cursor-pointer" variant="primary" color="sky">
                    Crear post
                </flux:button>
            </div>
        </form>
    </div>

</x-layouts.app>
