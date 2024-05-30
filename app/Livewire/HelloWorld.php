<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class HelloWorld extends ModalComponent
{
    public function render()
    {
        return view('livewire.hello-world');
    }
}
