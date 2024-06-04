<?php

namespace App\Livewire;

use App\Models\Herbarium;
use LivewireUI\Modal\ModalComponent;


class DeletePlant extends ModalComponent
{

    public Herbarium $herbarium;

    public $id;


    public function delete()
    {
        $plant = Herbarium::findOrFail($this->id);
 
        $collection_number = $plant->collection_number;

        $plant->delete();
        
        activity()
            ->performedOn($plant)
            ->withProperties(['collection_number'=>$collection_number])
            ->log('Plant deleted.');  

        $this->dispatch('refreshTable');
        $this->closeModal();

    }
    

    public function render()
    {
        return view('livewire.delete-plant');
    }

}
