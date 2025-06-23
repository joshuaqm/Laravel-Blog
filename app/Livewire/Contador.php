<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public $count = 0;

    public function increment($amount)
    {
        $this->count += $amount;
    }
    
    public function decrement()
    {
        $this->count--;
    }
    public function render()
    {
        return view('livewire.contador');
    }
}
