<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class HerbariumImageGallery extends ModalComponent
{
    public $selectedImage = null; // Stores the selected image URL

    public function selectImage($image)
    {
        $this->selectedImage = $image;
    }

    public function closeModal()
    {
        $this->selectedImage = null;
    }
    
    public function render()
    {
        return view('livewire.herbarium-image-gallery');
    }
}
