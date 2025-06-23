<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;


class CreatePost extends Component
{
    // Array, string, integer, float, boolean, null
    // Collection, model, datetime, etc.
    public $title;

    public $name, $email;
    
    public function mount(User $user)
    {
        // Initialize properties or perform actions before the component is rendered
        // $this->name = $user->name;
        // $this->email = $user->email;
        $this->fill(
            $user->only(['name', 'email'])
        );
    }

    public function save()
    {

    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
