<?php

namespace App\Livewire;

//use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AlertHerbarium extends ModalComponent
{

    public $Model = '';
    public $ColNum = '';

    public function mount()
    {
        //$this->Model = 'test this stuff out'; //$Model;
    }

    public function render()
    {
        return view('livewire.alert-herbarium');
    }
}
