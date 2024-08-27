<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Family;
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

            $family_from = "undefined";
            $result = Family::find($this->from_family_id);
            if ($result)
                $family_from = $result->family;

            $family_to = "undefined";
            $row = Family::find($this->to_family_id);
            if ($row)
                $family_to = $row->family;

            $affectedRows = Herbarium::where('family_id', $this->from_family_id)
                ->update(['family_id' => $this->to_family_id]);

            activity()
                ->performedOn($row)
                ->withProperties(['family'=>$family_from." > ".$family_to])
                ->log('Family replaced ('.$affectedRows.' entries).'); 

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
