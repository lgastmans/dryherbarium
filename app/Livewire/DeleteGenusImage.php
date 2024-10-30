<?php

namespace App\Livewire;

use App\Models\GenusImage;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteGenusImage extends ModalComponent
{
    public GenusImage $GenusImage;

    public $id;

    public function delete()
    {
        $genus_image = GenusImage::findOrFail($this->id);

        //$filename = $genus_image->filename;
 
        Storage::disk('public')->delete('photos/'.$genus_image->filename);

        $genus_image->delete();

        /*
        activity()
            ->performedOn($genus_image)
            ->withProperties(['filename'=>$filename])
            ->log('Genus image deleted.');
        */

        $this->dispatch('refreshGenusImageTable');
        $this->closeModal();

    }

    public function render()
    {
        return view('livewire.delete-genus-image');
    }
}
