<x-layouts.public>
    <ul class="space-y-6 mb-40">
        @foreach ($posts as $post)
            <li>
                <article class="bg-white dark:bg-zinc-800 rounded shadow-lg dark:shadow-zinc-900">
                    <img class="h-72 w-full object-cover object-center" src="{{$post->image}}" alt="">
                    <div class="p-6 py-2">
                        <h1 class="font-semibold text-xl mb-2 text-zinc-900 dark:text-zinc-100">
                            <a href="{{ route('posts.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h1>
                        <div class="text-zinc-700 dark:text-zinc-300">
                            {{ $post->excerpt }}
                        </div>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>

    <div>
        {{ $posts->links() }}
    </div>

</x-layouts.public>
