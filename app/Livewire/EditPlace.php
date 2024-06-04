<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Place;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditPlace extends ModalComponent
{
    public $id = null;
    public $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('places')->ignore($this->name), 
            ],
        ];
    }

    public function mount(Place $place)
    {
        $this->id = $place->id;
        $this->name = $place->name;
    }

    public function save()
    {
        $this->validate();

        $model = Place::find($this->id);

        $original = $model->name;

        $model->update([
            'name'=>$this->name,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['place'=>$original." > ".$this->name])
            ->log('Place updated.');   
 
        //return $this->redirect('/genus');
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-place');
    }
}
