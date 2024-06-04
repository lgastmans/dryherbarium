<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Taluk;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditTaluk extends ModalComponent
{
    public $id = null;
    public $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('taluks')->ignore($this->name), 
            ],
        ];
    }

    public function mount(Taluk $taluk)
    {
        $this->id = $taluk->id;
        $this->name = $taluk->name;
    }

    public function save()
    {
        $this->validate();

        $model = Taluk::find($this->id);

        $original = $model->name;

        $model->update([
            'name'=>$this->name,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['taluk'=>$original." > ".$this->name])
            ->log('Taluk updated.');   
 
        //return $this->redirect('/genus');
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-taluk');
    }
}
