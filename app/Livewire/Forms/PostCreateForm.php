<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostCreateForm extends Form
{
    #[Rule('required|min:3|max:255')]
    public $title;

    #[Rule('required')]
    public $slug;

    #[Rule('required')]
    public $excerpt;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('array')]
    public $selected_tags = [];

    #[Rule('nullable|image|max:1024')]
    public $image;

    public function save()
    {
        $this->slug = 'slug-default-' . time();
        $this->validate();
        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);
        $post->tags()->attach($this->selected_tags);

        if ($this->image) {
            $post->image_path = $this->image->store('posts2');
            $post->save(); 
        }
        
        $this->reset();
    }
}
