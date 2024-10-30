<?php

namespace App\Livewire;

use App\Models\Genus;
use LivewireUI\Modal\ModalComponent;

class ViewGenus extends ModalComponent
{
    public $genus = null;
    public $id = null;
    public $name = '';
    public $images;
    public $count = 0;


    public function mount(Genus $genus)
    {
        $this->genus = $genus;

        $this->id = $genus->id;
        $this->name = $genus->name;
        $this->images = $genus->images;
        $this->count = count($genus->images);
    }

    public function render()
    {
        return view('livewire.view-genus');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }    
}


