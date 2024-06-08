<?php

namespace App\Livewire;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

//use Livewire\Component;
use App\Models\Status;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateStatus extends ModalComponent
{

    public $name;

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('statuses')->ignore($this->name), 
            ],
        ];
    }

    public function save() 
    {
        $this->validate();

        $model = Status::create([
            'name' => $this->name
        ]);
 
        activity()
           ->performedOn($model)
           ->withProperties(['status'=>$this->name])
           ->log('Status added.'); 

        return redirect()->to('/statuses')
             ->with('status', 'Status created!');
    }

    public function render()
    {
        return view('livewire.create-status');
    }
}
