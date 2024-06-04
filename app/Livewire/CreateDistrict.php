<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\District;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateDistrict extends ModalComponent
{

    public $name;

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('districts')->ignore($this->name), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = District::create([
            'name' => $this->name
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['district'=>$this->name])
           ->log('District added.'); 

        return redirect()->to('/districts')
             ->with('status', 'District created!');
    }

    public function render()
    {
        return view('livewire.create-district');
    }
}
