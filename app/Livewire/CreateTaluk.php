<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\Taluk;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateTaluk extends ModalComponent
{
    public $name;

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('taluks')->ignore($this->name), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = Taluk::create([
            'name' => $this->name
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['taluk'=>$this->name])
           ->log('Taluk added.'); 

        return redirect()->to('/taluks')
             ->with('status', 'Taluk created!');
    }

    public function render()
    {
        return view('livewire.create-taluk');
    }
}
