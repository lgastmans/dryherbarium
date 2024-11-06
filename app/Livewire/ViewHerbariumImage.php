<?php

namespace App\Livewire;

use App\Models\Herbarium;
use LivewireUI\Modal\ModalComponent;

class ViewHerbariumImage extends ModalComponent
{
    public $herbarium = null;
    public $id = null;
    public $name = '';
    public $images;

    public function mount(Herbarium $herbarium)
    {
        $this->herbarium = $herbarium;
        
        $this->id = $herbarium->id;
        $this->name = $herbarium->name;
        $this->images = $herbarium->images;
    }

    public function render()
    {
        return view('livewire.view-herbarium-image');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

}
