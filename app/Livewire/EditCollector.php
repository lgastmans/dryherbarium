<?php

namespace App\Livewire;

//use Livewire\Component;
use App\Models\Collector;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditCollector extends ModalComponent
{
    public $id = null;
    public $name = '';
    public $surname = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                //Rule::unique('collectors')->ignore($this->name), 
            ],
            'name' => [
                'required',
                //Rule::unique('collectors')->ignore($this->name), 
            ],
        ];
    }

    public function mount(Collector $collector)
    {
        $this->id = $collector->id;
        $this->name = $collector->name;
        $this->surname = $collector->surname;
    }

    public function save()
    {
        $this->validate();

        $model = Collector::find($this->id);

        $original = $model->name;
        $original2 = $model->surname;

        $model->update([
            'name'=>$this->name,
            'surname'=>$this->surname,
        ]);

        activity()
            ->performedOn($model)
            ->withProperties(['collector'=>$original." ".$original2." > ".$this->name." ".$this->surname])
            ->log('Collector updated.');   
 
        $this->dispatch('refreshTable');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-collector');
    }
}
