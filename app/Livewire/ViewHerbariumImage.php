<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class ViewHerbariumImage extends ModalComponent
{
    public $imageUrl = '';

    public function mount($test)
    {

        $this->imageUrl = $test;
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
