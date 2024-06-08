<?php
namespace App\Livewire;

use Spatie\LaravelPdf\Facades\Pdf;
use App\Livewire\Forms\PlantForm;
use Livewire\Component;
use App\Models\Herbarium;

use Livewire\Attributes\Title;


class UpdatePlant extends Component
{

    public PlantForm $form;
    

    public function mount(Herbarium $herbarium)
    {
        $this->form->setPlant($herbarium);
    }


    public function save()
    {
        $this->form->update();

        return $this->redirect('/plants');
    }

    public function cancel()
    {
        return $this->redirect('/plants');
    }

    #[Title('Update Plant')]
    public function render()
    {
        return view('livewire.create-plant', [$this->form])
            ->layout('layouts.app');
    }

}
