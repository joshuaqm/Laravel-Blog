<x-layouts.app :title="__('Posts')">

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush

    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
            <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="">Editar</flux:breadcrumbs.item>

        </flux:breadcrumbs>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="relative mb-2">
            {{-- <img  class="w-full aspect-video object-cover" src="https://imgs.search.brave.com/_P-lWzE9st9gz1OY75ww4PgXSLJXPB30AKvi3VAOEzM/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdDQu/ZGVwb3NpdHBob3Rv/cy5jb20vMTQ5NTM4/NTIvMjI3NzIvdi80/NTAvZGVwb3NpdHBo/b3Rvc18yMjc3MjQ5/OTItc3RvY2staWxs/dXN0cmF0aW9uLWlt/YWdlLWF2YWlsYWJs/ZS1pY29uLWZzYXQt/dmVjdG9yLmpwZw" alt=""> --}}
            <img id="imgPreview" class="w-full aspect-video object-cover" src="{{ $post->image }}" alt="">
            <div class="absolute top-0 right-0">
                <label class="bg-gray-600 text-white px-4 py-2 rounded-lg cursor-pointer">
                    Cambiar imagen
                    <input type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>

        <div class="card space-y-4">
            <flux:input name="title" label="Título del post" value="{{ old('title', $post->title) }}"  placeholder="Ingrese el título del post" />
            <flux:input name="slug" id="slug" label="Slug del post" value="{{ old('slug', $post->slug) }}"  placeholder="Ingrese el slug del post" />
            <flux:select name="category_id" label="Categoría" placeholder="Seleccione una categoría...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}" :selected="$category->id == old('category_id', $post->category_id)">
                        {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:textarea label="Resumen" name="excerpt">{{ old('excerpt', $post->excerpt) }}</flux:textarea>

            <div>
                <p class="font-medium text-sm mb-1">
                    Contenido
                </p>
                <div id="editor">{!!old('content', $post->content)!!}</div>
                <textarea class="hidden" name="content" id="content">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- <flux:textarea label="Contenido" name="content" rows="16">{{ old('content', $post->content) }}</flux:textarea> --}}

            <div>
                <p class="text-sm font-medium mb-1">
                    Etiquetas
                </p>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    @checked(
                                        (in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray()) ) )
                                    )
                                >
                                <span>{{ $tag->name }}</span>
                            </label>
                        </li>

                    @endforeach
                </ul>
            </div>

            <div>
                <p class="text-sm font-medium mb-1">Estado</p>
                <div class="flex space-x-3">
                    <label class="flex items-center">
                        <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0)>
                        <span class="ml-2">
                            No publicado
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1)>
                        <span class="ml-2">
                            Publicado
                        </span>
                    </label>
                </div>
            </div>
            

            <div class="flex justify-end">
                <flux:button type="submit" class="mt-4 cursor-pointer" variant="primary" color="sky">
                    Editar post
                </flux:button>
            </div>
        </div>
    </form>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });
        </script>
    @endpush
</x-layouts.app>
