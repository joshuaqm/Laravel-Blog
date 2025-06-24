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

    public $post_edit_id = '';
    public $post_edit = [
        'category_id' => '',
        'title' => '',
        'slug' => '',
        'excerpt' => '',
        'content' => '',
        'selected_tags' => [],
    ];
    public $open = false;
 
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
        return redirect()->route('admin.posts.index')->with('message', 'Post created successfully!');
    }

    public function edit($post_id)
    {
        $this->open = true;
        $this->post_edit_id = $post_id;
        $post = Post::find($post_id);
        $this->post_edit = [
            'category_id' => $post->category_id,
            'title' => $post->title,
            'slug' => $post->slug,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'selected_tags' => $post->tags->pluck('id')->toArray(),
        ];
    }

    public function update()
    {
        $post = Post::find($this->post_edit_id);
        $this->validate([
            'post_edit.title' => 'required|min:3|max:255',
            'post_edit.excerpt' => 'required|min:10|max:255',
            'post_edit.content' => 'required|min:10',
            'post_edit.category_id' => 'required|exists:categories,id',
            'post_edit.selected_tags' => 'array',
        ]);

        $post->update([
            'category_id' => $this->post_edit['category_id'],
            'title' => $this->post_edit['title'],
            'slug' => 'slug-default-' . time(),
            'excerpt' => $this->post_edit['excerpt'],
            'content' => $this->post_edit['content'],
        ]);
        $post->tags()->sync($this->post_edit['selected_tags']);
        $this->reset(['post_edit_id', 'post_edit', 'open']);
        $this->posts = Post::orderBy('id', 'desc')->get();
    }   

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if ($post) {
            $post->tags()->detach();
            $post->delete();
            $this->posts = Post::orderBy('id', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
