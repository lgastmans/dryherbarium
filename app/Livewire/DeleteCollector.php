<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Collector;
use App\Models\Herbarium;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class DeleteCollector extends ModalComponent
{
    public Collector $collector;

    public $id;

    public $original;

    public function delete()
    {
        $herbarium = Herbarium::where('collector1_id','=',$this->id)
            ->orWhere('collector2_id','=',$this->id)
            ->orWhere('collector3_id','=',$this->id)
            ->first();

        if ($herbarium) {
            $this->dispatch('collector-exists', Model: 'Collector', ColNum: $herbarium->collection_number);
        }
        else {

            $model = Collector::findOrFail($this->id);
     
            $original = $model->name." ".$model->surname;

            $model->delete();
            
            activity()
                ->performedOn($model)
                ->withProperties(['collector'=>$original])
                ->log('Collector deleted.');  

            $this->dispatch('refreshTable');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-collector');
    }
}
