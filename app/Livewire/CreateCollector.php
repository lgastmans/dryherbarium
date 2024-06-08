<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\Collector;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateCollector extends ModalComponent
{
    public $name;
    public $surname;

    public function rules()
    {
        return [
            'name' => [
                'required',
                //Rule::unique('collectors')->ignore($this->name), 
            ],
            'surname' => [
                'required',
                //Rule::unique('collectors')->ignore($this->name), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = Collector::create([
            'name' => $this->name,
            'surname' => $this->surname,
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['collector'=>$this->name." ".$this->surname])
           ->log('Collector added.'); 

        return redirect()->to('/collectors')
             ->with('status', 'Collector created!');
    }

    public function render()
    {
        return view('livewire.create-collector');
    }
}
