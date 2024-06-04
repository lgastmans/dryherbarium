<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Family;
use App\Models\Herbarium;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class DeleteFamily extends ModalComponent
{

    public Family $family;

    public $id;


    /*
    public function rules()
    {
        return [
            'id' => [
                Rule::exists('herbarium', 'family_id')
            ],
        ];
    }
    */
    

    public function delete()
    {
        $herbarium = Herbarium::where('family_id','=',$this->id)->first();

        if ($herbarium) {
            $this->dispatch('family-exists', Model: 'Family', ColNum: $herbarium->collection_number);
        }
        else {

            $model = Family::findOrFail($this->id);
     
            $family = $model->family;

            $model->delete();
            
            activity()
                ->performedOn($model)
                ->withProperties(['family'=>$family])
                ->log('Family deleted.');  

            $this->dispatch('refreshTable');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-family');
    }
}
