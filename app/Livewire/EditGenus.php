<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Genus;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditGenus extends ModalComponent
{
    public $id = null;
    public $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('genus')->ignore($this->name), 
            ],
        ];
    }

    public function mount(Genus $genus)
    {
        $this->id = $genus->id;
        $this->name = $genus->name;
    }

    public function save()
    {
        $this->validate();

        $model = Genus::find($this->id);

        $original = $model->name;

        $model->update([
            'name'=>$this->name,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['genus'=>$original." > ".$this->name])
            ->log('Genus updated.');   
 
        //return $this->redirect('/genus');
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-genus');
    }
}
