<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;

    public $title, $slug, $excerpt, $content, $category_id = "", $selected_tags = [];

    public $posts;
 
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::orderBy('id', 'desc')->get();
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3|max:255',
            'excerpt' => 'required|min:10|max:255',
            'content' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'selected_tags' => 'array',
        ]);
        $post = Post::create([
            'title' => $this->title,
            'slug' => 'slug-default-' . time(),
            'content' => $this->content,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);
        // $post = Post::create([
        //     $this->only(['title', 'slug', 'excerpt', 'content', 'category_id']),
        //     'slug' => 'slug-default-' . time(),
        //     'user_id' => auth()->id(),
        // ]);
        $post->tags()->attach($this->selected_tags);

        $this->reset(['title', 'slug', 'excerpt', 'content', 'category_id', 'selected_tags']);
        $this->posts = Post::orderBy('id', 'desc')->get();
        
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
