<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Herbarium;

class ReplaceFamily extends Component
{

    public $from_family_id;
    public $to_family_id;

    public function save() 
    {
        $this->validate([
            'from_family_id' => 'required',
            'to_family_id' => 'required',
        ]);

        $rows = Herbarium::where('family_id', $this->from_family_id)->get();

        if ($rows->count() > 0) {

            $affectedRows = Herbarium::where('family_id', $this->from_family_id)
                ->update(['family_id' => $this->to_family_id]);

            session()->flash('family-replaced', $affectedRows.' herbarium entries successfully replaced');
        }
        else {

            session()->flash('family-not-found', 'The family specified was not found in the Herbarium');

        }

        return $this->redirect('/plants/replace-family');
    }

    public function render()
    {
        return view('livewire.replace-family')
            ->layout('layouts.app');
    }
}
