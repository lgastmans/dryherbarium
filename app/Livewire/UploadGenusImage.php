<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

use App\Models\GenusImage;

class UploadGenusImage extends Component
{
    use WithFileUploads;
 
    #[Validate('image|mimes:jpeg,png,jpg,gif,svg|max:5000')] 
    public $photo;

    public $genus_id = null;
 

    public function mount($genus_id = null)
    {
        $this->genus_id = $genus_id;
    }

    public function save()
    {
        // Store the file
        $filename = $this->photo->getClientOriginalName();

        $this->photo->storeAs('photos', $filename, 'public');

        $model = GenusImage::create(['genus_id' => $this->genus_id, 'filename' => $filename]);

        $genus = Genus::findOrFail($this->genus_id);

        activity()
           ->performedOn($model)
           ->withProperties(['name'=>$genus->name])
           ->log('Image added.');         

        $this->dispatch('refreshGenusImageTable');
    }
    
    public function render()
    {
        return view('livewire.upload-genus-image')->layout('layouts.app');
    }
}
