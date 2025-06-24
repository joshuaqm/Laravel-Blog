<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;

    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;

    public $posts;

    public $open = false;
 
    // public function rules()
    // {
    //     return [
    //         'title' => 'required|min:3|max:255',
    //         'excerpt' => 'required|min:10|max:255',
    //         'content' => 'required|min:10',
    //         'category_id' => 'required|exists:categories,id',
    //         'selected_tags' => 'array',
    //     ];
    // }
    //Ciclo de vida de un componente
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::orderBy('id', 'desc')->limit(5)->get();
    }

    public function updating($property, $value)
    {
        // dd('Updating property:', $property, 'with value:', $value);
    }
    public function hydrate(){
        // dd('Hydrating component');
    }
    public function save()
    {
        // $this->postCreate->slug = 'slug-default-' . time();
        // $this->postCreate->validate();
        // $this->validate([
        //     'title' => 'required|min:3|max:255',
        //     'excerpt' => 'required|min:10|max:255',
        //     'content' => 'required|min:10',
        //     'category_id' => 'required|exists:categories,id',
        //     'selected_tags' => 'array',
        // ],
        // [
        //     'title.required' => 'El campo titulo es requerido.',
        //     'title.min' => 'El campo titulo debe tener al menos 3 caracteres.',
        // ],
        // [
        //     'category_id' => 'categoría',
        // ]);

        // $post = Post::create([
        //     'title' => $this->postCreate->title,
        //     'slug' => $this->postCreate->slug,
        //     'excerpt' => $this->postCreate->excerpt,
        //     'content' => $this->postCreate->content,
        //     'category_id' => $this->postCreate->category_id,
        //     'user_id' => auth()->id(),
        // ]);
        // $post = Post::create([
        //     $this->only(['title', 'slug', 'excerpt', 'content', 'category_id']),
        //     'slug' => 'slug-default-' . time(),
        //     'user_id' => auth()->id(),
        // ]);
        // $post->tags()->attach($this->postCreate->selected_tags);

        // $this->postCreate->reset();
        $this->postCreate->save();
        $this->posts = Post::orderBy('id', 'desc')->limit(5)->get();
        $this->dispatch('post-created', 'Nuevo articulo creado ' . time());
        // return redirect()->route('admin.posts.index')->with('message', 'Post created successfully!');
    }

    public function edit($post_id)
    {
        $this->resetValidation();
        $this->postEdit->edit($post_id);
        // $this->postEdit->open = true;

        // $this->postEdit->id = $post_id;
        // $post = Post::find($post_id);

        // $this->postEdit->category_id = $post->category_id;
        // $this->postEdit->title = $post->title;
        // $this->postEdit->slug = $post->slug;
        // $this->postEdit->excerpt = $post->excerpt;
        // $this->postEdit->content = $post->content;
        // $this->postEdit->selected_tags = $post->tags->pluck('id')->toArray();
    }

    public function update()
    {
        // $post = Post::find($this->postEdit->id);
        // // $this->validate([
        // //     'post_edit.title' => 'required|min:3|max:255',
        // //     'post_edit.excerpt' => 'required|min:10|max:255',
        // //     'post_edit.content' => 'required|min:10',
        // //     'post_edit.category_id' => 'required|exists:categories,id',
        // //     'post_edit.selected_tags' => 'array',
        // // ]);

        // $post->update([
        //     'category_id' => $this->postEdit->category_id,
        //     'title' => $this->post_edit['title'],
        //     'slug' => 'slug-default-' . time(),
        //     'excerpt' => $this->post_edit['excerpt'],
        //     'content' => $this->post_edit['content'],
        // ]);
        // $post->tags()->sync($this->post_edit['selected_tags']);
        // $this->reset(['post_edit_id', 'post_edit', 'open']);
        $this->postEdit->update();
        $this->dispatch('post-created', 'Articulo actualizado ' . time());
        $this->posts = Post::orderBy('id', 'desc')->limit(5)->get();

    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->tags()->detach();
        $post->delete();
        $this->dispatch('post-created', 'Articulo eliminado ' . time());
        $this->posts = Post::orderBy('id', 'desc')->limit(5)->get();

    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
