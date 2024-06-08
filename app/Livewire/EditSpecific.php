<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Specific;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditSpecific extends ModalComponent
{
    public $id = null;
    public $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('specifics')->ignore($this->name), 
            ],
        ];
    }

    public function mount(Specific $specific)
    {
        $this->id = $specific->id;
        $this->name = $specific->name;
    }

    public function save()
    {
        $this->validate();

        $model = Specific::find($this->id);

        $original = $model->name;

        $model->update([
            'name'=>$this->name,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['specific'=>$original." > ".$this->name])
            ->log('Specific updated.');   
 
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-specific');
    }
}
