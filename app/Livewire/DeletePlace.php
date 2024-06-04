<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Place;
use App\Models\Herbarium;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class DeletePlace extends ModalComponent
{
    public Place $place;

    public $id;

    public $original;

    public function delete()
    {
        $herbarium = Herbarium::where('place_id','=',$this->id)->first();

        if ($herbarium) {
            $this->dispatch('place-exists', Model: 'Place', ColNum: $herbarium->collection_number);
        }
        else {

            $model = Place::findOrFail($this->id);
     
            $original = $model->name;

            $model->delete();
            
            activity()
                ->performedOn($model)
                ->withProperties(['place'=>$original])
                ->log('Place deleted.');  

            $this->dispatch('refreshTable');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-place');
    }
}
