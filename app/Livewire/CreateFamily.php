<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\Family;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateFamily extends ModalComponent
{
    public $family;

    public function rules()
    {
        return [
            'family' => [
                'required',
                Rule::unique('families')->ignore($this->family), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = Family::create([
            'family' => $this->family
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['family'=>$this->family])
           ->log('Family added.'); 

        return redirect()->to('/families')
             ->with('status', 'Family created!');
    }    

    public function render()
    {
        return view('livewire.create-family');
    }
}
