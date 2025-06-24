<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use App\Models\Post;
use Livewire\Form;

class PostEditForm extends Form
{
    
    public $post_id = '';
    public $open = false;


    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $slug;

    #[Rule('required')]
    public $excerpt;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id;

    public $selected_tags = [];

    public function edit($post_id)
    {
        $this->open = true;
        $this->post_id = $post_id;

        $post = Post::find($post_id);

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->excerpt = $post->excerpt;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->selected_tags = $post->tags()->pluck('tags.id')->toArray();
    }

    public function update()
    {
        $post = Post::find($this->post_id);
        $this->validate();
        
        $post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'category_id' => $this->category_id,
        ]);

        $post->tags()->sync($this->selected_tags);

        $this->reset();
    }
}
