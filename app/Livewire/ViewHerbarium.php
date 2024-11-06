<?php
/*
    These are the images display in the modal popup on the Herbarium grid 
*/

namespace App\Livewire;

use App\Models\Herbarium;
use Livewire\Attributes\On; 
use LivewireUI\Modal\ModalComponent;

class ViewHerbarium extends ModalComponent
{
    public $herbarium = null;
    public $id = null;
    public $name = '';
    public $images;

    public $showImageModal = false;
    public $imageUrl = '';

    public function mount(Herbarium $herbarium)
    {
        $this->herbarium = $herbarium;
        
        $this->id = $herbarium->id;
        $this->name = $herbarium->name;
        $this->images = $herbarium->images;

        $this->imageUrl = '';
    }

    public function render()
    {
        return view('livewire.view-herbarium');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    #[On('openImageModal')] 
    public function showTheImage($imageUrl)
    {
        //$this->imageUrl = $this->imageUrl;
    }    

}
