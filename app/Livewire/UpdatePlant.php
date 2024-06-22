<?php
namespace App\Livewire;


use App\Livewire\Forms\PlantForm;
use Livewire\Component;
use App\Models\Herbarium;

use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;


class UpdatePlant extends Component
{

    public PlantForm $form;
    
    public $id;

    public function mount(Herbarium $herbarium)
    {
        $this->form->setPlant($herbarium);

        $this->id = $herbarium->id;
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


    public function label()
    {

        $herbarium = Herbarium::find($this->id);

        $data = [
            'title' => 'Herbarium',
            'address' => 'Auroville, Tamil Nadu, India',
            'herbarium' => $herbarium,
        ];

        $pdf = Pdf::loadView('herbarium-label', $data);
        // return $pdf->download('herbarium-label.pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'herbarium-label-'.$herbarium->collection_number.'.pdf');
    }    


    #[Title('Update Plant')]
    public function render()
    {
        return view('livewire.create-plant', [$this->form])
            ->layout('layouts.app');
    }

}
