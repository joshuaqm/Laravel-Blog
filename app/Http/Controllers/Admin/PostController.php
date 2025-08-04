<?php

namespace App\Http\Controllers\Admin;

use App\Events\UploadedImage;
use App\Http\Controllers\Controller;
use App\Jobs\ResizeImage;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('can:crear post')->only(['create', 'store']);
    //     $this->middleware('can:editar post')->only(['edit', 'update']);
    //     $this->middleware('can:ver post')->only(['index', 'show']);
    // }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
            ->where('user_id', auth('web')->id())
            ->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data['user_id'] = auth('web')->id();

        $post = Post::create($data);    

        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post ha sido creado correctamente.',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        Gate::authorize('author', $post);
        $categories = Category::all();
        // $tags = $post->tags->pluck('id')->toArray();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:20480', // 20MB
            'tags' => 'nullable|array',
            // 'tags.*' => 'exists:tags,id',
            'is_published' => 'required|boolean',
        ]);
        //Lo cambiamos por el observer
        // if($data['is_published'] && !$post->published_at) {
        //     $data['published_at'] = now();
        // }

        if($request->hasFile('image')) {
            if($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            $extension = $request->image->extension();
            $nameFile = $post->slug . '.' . $extension;

            // CORRECCIÓN: Usar el mismo disco para verificar si existe
            while (Storage::disk('public')->exists('posts/' . $nameFile)) {
                $nameFile = str_replace('.' . $extension, '-copia.' . $extension, $nameFile);
            }

            $data['image_path'] = Storage::putFileAs('posts', $request->image, $nameFile);
            
            UploadedImage::dispatch($data['image_path']);
        }

        $tags = [];
        foreach($request->tags ?? [] as $tag){
            $tags[] = Tag::firstOrCreate(['name' => $tag]);
        }

        $post->tags()->sync($tags);

        $post->update($data);
        session()->flash('swal',[
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post ha sido actualizado correctamente.',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    if($post->image_path) {
        Storage::disk('public')->delete($post->image_path);
    }

    $post->tags()->detach();
    $post->delete();

    session()->flash('swal',[
        'icon' => 'success',
        'title' => '¡Bien hecho!',
        'text' => 'El post ha sido eliminado correctamente.',
    ]);

    return redirect()->route('admin.posts.index');
}
}
