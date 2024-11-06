<?php

namespace App\Livewire;

use App\Models\HerbariumImages;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteHerbariumImage extends ModalComponent
{
    public HerbariumImages $HerbariumImages;

    public $id;

    public function delete()
    {
        $herbarium_image = HerbariumImages::findOrFail($this->id);

        //$filename = $genus_image->filename;
 
        Storage::disk('public')->delete('herbarium/'.$herbarium_image->filename);

        $herbarium_image->delete();

        /*
        activity()
            ->performedOn($genus_image)
            ->withProperties(['filename'=>$filename])
            ->log('Genus image deleted.');
        */

        $this->dispatch('refreshHerbariumImageTable');
        //$this->closeModal();

    }

    public function render()
    {
        return view('livewire.delete-herbarium-image');
    }
}
