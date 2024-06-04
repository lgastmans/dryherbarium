<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\District;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditDistrict extends ModalComponent
{
    public $id = null;
    public $name = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('districts')->ignore($this->name), 
            ],
        ];
    }

    public function mount(District $district)
    {
        $this->id = $district->id;
        $this->name = $district->name;
    }

    public function save()
    {
        $this->validate();

        $model = District::find($this->id);

        $original = $model->name;

        $model->update([
            'name'=>$this->name,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['district'=>$original." > ".$this->name])
            ->log('District updated.');   
 
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-district');
    }
}
