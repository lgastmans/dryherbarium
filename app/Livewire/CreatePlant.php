<?php
namespace App\Livewire;

use App\Livewire\Forms\PlantForm;
use Livewire\Component;
use App\Models\Herbarium;

use Livewire\Attributes\Title;


class CreatePlant extends Component
{

    public PlantForm $form;


    public function save() 
    {
        $this->form->store();

        session()->flash('status', 'Plant successfully created');

        return $this->redirect('/plants');
    }

    public function cancel()
    {
        return $this->redirect('/plants');
    }
    
    #[Title('Create Plant')]
    public function render()
    {
        return view('livewire.create-plant')
            ->layout('layouts.app');
    }
}
