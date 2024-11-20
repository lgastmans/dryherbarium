<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

use App\Models\HerbariumImages;

class UploadHerbariumImage extends Component
{
    use WithFileUploads;
 
    #[Validate('image|mimes:jpeg,png,jpg,gif,svg|max:5000')] 
    public $photo;

    public $herbarium_id = null;
    public $genus_id = null;

    public function mount($herbarium_id = null, $genus_id = null)
    {
        $this->herbarium_id = $herbarium_id;
        $this->genus_id = $genus_id;
    }

    public function save()
    {
        if ($photo) {
            // Store the file
            $filename = $this->photo->getClientOriginalName();

            $this->photo->storeAs('herbarium', $filename, 'public');

            HerbariumImages::create(['herbarium_id'=>$this->herbarium_id, 'genus_id'=>$this->genus_id, 'filename'=>$filename]);

            $this->dispatch('refreshHerbariumImageTable');
        }
    }

    public function render()
    {
        return view('livewire.upload-herbarium-image');
    }
}
