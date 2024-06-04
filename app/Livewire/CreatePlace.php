<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\Place;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreatePlace extends ModalComponent
{
    public $name;

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('places')->ignore($this->name), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = Place::create([
            'name' => $this->name
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['name'=>$this->name])
           ->log('Place added.'); 

        return redirect()->to('/places')
             ->with('status', 'Place created!');
    }

    public function render()
    {
        return view('livewire.create-place');
    }
}
