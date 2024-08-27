<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Herbarium;

class ReplaceGenus extends Component
{
    public $from_genus_id;
    public $to_genus_id;

    public function save() 
    {
        $this->validate([
            'from_genus_id' => 'required',
            'to_genus_id' => 'required',
        ]);

        $rows = Herbarium::where('genus_id', $this->from_genus_id)->get();

        if ($rows->count() > 0) {

            $affectedRows = Herbarium::where('genus_id', $this->from_genus_id)
                ->update(['genus_id' => $this->to_genus_id]);

            //dispatch('genus-replaced');
            session()->flash('genus-replaced', $affectedRows.' genus(es) successfully replaced');
        }
        else {

            session()->flash('genus-not-found', 'The genus specified was not found in the Herbarium');

        }

        return $this->redirect('/plants/replace-genus');
    }

    public function render()
    {
        return view('livewire.replace-genus')
            ->layout('layouts.app');
    }
}
