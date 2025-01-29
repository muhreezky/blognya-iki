<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public $open = false;
    public function render()
    {
        return view('livewire.navbar');
    }

    public function toggle()
    {
        $this->open = !$this->open;
    }
}
