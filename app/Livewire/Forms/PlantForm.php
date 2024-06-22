<?php

namespace App\Livewire\Forms;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

use Livewire\Attributes\Validate;
use App\Models\Herbarium;
use Livewire\Form;



/**
 * 
 * called from 
 * 
 * app/Livewire/UpdatePlant.php
 * 
 */


class PlantForm extends Form
{

    public ?Herbarium $herbarium;

    public $id = '';

    #[Validate('required')]
    public $genus_id = null;
    public $genus = '';

    #[Validate('required')]
    public $family_id = null;
    public $family = '';

    public $place_id = null;
    public $place = '';

    public $taluk_id = null;
    public $taluk = '';

    public $district_id = null;
    public $district = '';

    public $state_id = null;
    public $state = '';

    public $specific_id = null;
    public $specific = '';

    public $status_id = null;
    public $status = '';

    public $collector1_id = null;
    public $collector1 = '';

    public $collector2_id = null;
    public $collector2 = '';

    public $collector3_id = null;
    public $collector3 = '';


    #[Validate('required|max:32')]
    public $collection_number = '';
 
    public $vernacular_name = '';

    public $herbarium_number = '';

    public $collected_on = null;

    public $latitude = '';
    public $longitude = '';
    public $altitude = '';
    public $habit = '';
    public $frequency = '';
    public $micro_habitat = '';
    public $forest = '';
    public $phenology = '';
    public $quantity_main = 0;
    public $quantity_duplicate = 0;
    public $quantity_lent = '';
    public $description = '';
    public $association = '';
    public $leaf = '';
    public $flower = '';
    public $fruit = '';
    public $seeds = '';
    public $notes = '';


    public function setPlant(Herbarium $herbarium)
    {
        $this->herbarium = $herbarium;

        $this->id = $herbarium->id;

        $this->genus_id = $herbarium->genus_id;
        $this->genus = (!is_null($herbarium->genus)? $herbarium->genus->name : '');

        $this->family_id = $herbarium->family_id;
        $this->family = (!is_null($herbarium->family)? $herbarium->family->family : '');

        $this->place_id = $herbarium->place_id;
        $this->place = (!is_null($herbarium->place)? $herbarium->place->name : '');

        $this->taluk_id = $herbarium->taluk_id;
        $this->taluk = (!is_null($herbarium->taluk)? $herbarium->taluk->name : '');

        $this->district_id = $herbarium->district_id;
        $this->district = (!is_null($herbarium->district)? $herbarium->district->name : '');

        $this->state_id = $herbarium->state_id;
        $this->state = (!is_null($herbarium->state)? $herbarium->state->name : '');

        $this->specific_id = $herbarium->specific_id;
        $this->specific = (!is_null($herbarium->specific)? $herbarium->specific->name : '');

        $this->status_id = $herbarium->status_id;
        $this->status = (!is_null($herbarium->status)? $herbarium->status->name : '');        

        $this->collector1_id = $herbarium->collector1_id;
        $this->collector1 = (!is_null($herbarium->collector1)? $herbarium->collector1->name : '');   

        $this->collector2_id = $herbarium->collector2_id;
        $this->collector2 = (!is_null($herbarium->collector2)? $herbarium->collector2->name : '');   

        $this->collector3_id = $herbarium->collector3_id;
        $this->collector3 = (!is_null($herbarium->collector3)? $herbarium->collector3->name : '');   

        $this->collection_number = $herbarium->collection_number;
        $this->vernacular_name = $herbarium->vernacular_name;
        $this->herbarium_number = $herbarium->herbarium_number;
        $this->collected_on = $herbarium->collected_on;
        $this->latitude = $herbarium->latitude;
        $this->longitude = $herbarium->longitude;
        $this->altitude = $herbarium->altitude;
        $this->habit = $herbarium->habit;
        $this->frequency = $herbarium->frequency;
        $this->micro_habitat = $herbarium->micro_habitat;
        $this->forest = $herbarium->forest;
        $this->phenology = $herbarium->phenology;
        $this->quantity_main = $herbarium->quantity_main;
        $this->quantity_duplicate = $herbarium->quantity_duplicate;
        $this->quantity_lent = $herbarium->quantity_lent;
        $this->description = $herbarium->description;
        $this->association = $herbarium->association;
        $this->leaf = $herbarium->leaf;
        $this->flower = $herbarium->flower;
        $this->fruit = $herbarium->fruit;
        $this->seeds = $herbarium->seeds;
        $this->notes = $herbarium->notes;

    }

    public function store() 
    {
        $this->validate();
 
        $model = Herbarium::get('id')->first();

        Herbarium::create([
            'genus_id' => $this->genus_id,
            'family_id' => $this->family_id,
            'place_id' => $this->place_id,
            'taluk_id' => $this->taluk_id,
            'district_id' => $this->district_id,
            'state_id' => $this->state_id,
            'specific_id' => $this->specific_id,
            'status_id' => $this->status_id,
            'collector1_id' => $this->collector1_id,
            'collector2_id' => $this->collector2_id,
            'collector3_id' => $this->collector3_id,

            'collection_number' => $this->collection_number,
            'vernacular_name' => $this->vernacular_name,
            'herbarium_number' => $this->herbarium_number,
            'collected_on' => $this->collected_on,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'habit' => $this->habit,
            'frequency' => $this->frequency,
            'micro_habitat' => $this->micro_habitat,
            'forest' => $this->forest,
            'phenology' => $this->phenology,
            'quantity_main' => $this->quantity_main,
            'quantity_duplicate' => $this->quantity_duplicate,
            'quantity_lent' => $this->quantity_lent,
            'description' => $this->description,
            'association' => $this->association,
            'leaf' => $this->leaf,
            'flower' => $this->flower,
            'fruit' => $this->fruit,
            'seeds' => $this->seeds,
            'notes' => $this->notes,
        ]);

        activity()
           ->performedOn($model)
           ->withProperties(['collection_number'=>$this->collection_number])
           ->log('Plant added.');        
    }

    public function update()
    {
        $this->validate();
        //dd('family_id',$this->family_id);

        $model = Herbarium::with('family')->find($this->id);

        $this->herbarium->update([
            'genus_id' => $this->genus_id,
            'family_id' => $this->family_id,
            'place_id' => $this->place_id,
            'taluk_id' => $this->taluk_id,
            'district_id' => $this->district_id,
            'state_id' => $this->state_id,
            'specific_id' => $this->specific_id,
            'status_id' => $this->status_id,
            'collector1_id' => $this->collector1_id,
            'collector2_id' => $this->collector2_id,
            'collector3_id' => $this->collector3_id,

            'collection_number' => $this->collection_number,
            'vernacular_name' => $this->vernacular_name,
            'herbarium_number' => $this->herbarium_number,
            'collected_on' => $this->collected_on,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'habit' => $this->habit,
            'frequency' => $this->frequency,
            'micro_habitat' => $this->micro_habitat,
            'forest' => $this->forest,
            'phenology' => $this->phenology,
            'quantity_main' => $this->quantity_main,
            'quantity_duplicate' => $this->quantity_duplicate,
            'quantity_lent' => $this->quantity_lent,
            'description' => $this->description,
            'association' => $this->association,
            'leaf' => $this->leaf,
            'flower' => $this->flower,
            'fruit' => $this->fruit,
            'seeds' => $this->seeds,
            'notes' => $this->notes,
        ]);


        if ($this->herbarium->wasChanged()) {
            //$changedFields = array_diff($model->getOriginal(), $this->herbarium->getOriginal());
            //dd($changedFields, $model->getOriginal(), $this->herbarium->getOriginal());

            /*
            $activityProperties = [];
            foreach($changedFields as $key=>$value) {
                if ($key!='updated_at')
                    $activityProperties[$key] = $value." > ".$this->herbarium->$key;
            }
            */
            //dd($activityProperties);

            if ($this->herbarium->wasChanged('genus_id')) {
                $this->herbarium->load('genus');
                $arrChanged['genus'] = $model->genus->name." > ".$this->herbarium->genus->name;
            }

            if ($this->herbarium->wasChanged('family_id')) {
                $this->herbarium->load('family');
                $arrChanged['family'] = $model->family->family." > ".$this->herbarium->family->family;
            }

            if ($this->herbarium->wasChanged('place_id')) {
                $this->herbarium->load('place');
                $arrChanged['place'] = $model->place->name." > ".$this->herbarium->place->name;
            }

            if ($this->herbarium->wasChanged('taluk_id')) {
                $this->herbarium->load('taluk');
                $arrChanged['taluk'] = $model->taluk->name." > ".$this->herbarium->taluk->name;
            }

            if ($this->herbarium->wasChanged('district_id')) {
                $this->herbarium->load('district');
                $arrChanged['district'] = $model->district->name." > ".$this->herbarium->district->name;
            }

            if ($this->herbarium->wasChanged('state_id')) {
                $this->herbarium->load('state');
                $arrChanged['state'] = $model->state->name." > ".$this->herbarium->state->name;
            }

            if ($this->herbarium->wasChanged('specific_id')) {
                $this->herbarium->load('specific');
                $arrChanged['specific'] = $model->specific->name." > ".$this->herbarium->specific->name;
            }

            if ($this->herbarium->wasChanged('status_id')) {
                $this->herbarium->load('status');
                $arrChanged['status'] = $model->status->name." > ".$this->herbarium->status->name;
            }

            if ($this->herbarium->wasChanged('collector1_id')) {
                $this->herbarium->load('collector1');
                $arrChanged['collector1'] = (is_null($model->collector1->name)? '' : $model->collector1->display_collector)." > ".$this->herbarium->collector1->display_collector;
            }

            if ($this->herbarium->wasChanged('collector2_id')) {
                $this->herbarium->load('collector2');
                $arrChanged['collector2'] = (is_null($model->collector2->name)? '' : $model->collector2->display_collector)." > ".$this->herbarium->collector2->display_collector;
            }

            if ($this->herbarium->wasChanged('collector3_id')) {
                $this->herbarium->load('collector3');
                $arrChanged['collector3'] = (is_null($model->collector3->name)? '' : $model->collector3->display_collector)." > ".$this->herbarium->collector3->display_collector;
            }


            if ($this->herbarium->wasChanged('collection_number'))
                $arrChanged['collection_number'] = $model->collection_number." > ".$this->herbarium->collection_number;
            if ($this->herbarium->wasChanged('vernacular_name'))
                $arrChanged['vernacular_name'] = $model->vernacular_name." > ".$this->herbarium->vernacular_name;
            if ($this->herbarium->wasChanged('herbarium_number'))
                $arrChanged['herbarium_number'] = $model->herbarium_number." > ".$this->herbarium->herbarium_number;
            if ($this->herbarium->wasChanged('collected_on'))
                $arrChanged['collected_on'] = $model->collected_on." > ".$this->herbarium->collected_on;
            if ($this->herbarium->wasChanged('latitude'))
                $arrChanged['latitude'] = $model->latitude." > ".$this->herbarium->latitude;
            if ($this->herbarium->wasChanged('longitude'))
                $arrChanged['longitude'] = $model->longitude." > ".$this->herbarium->longitude;
            if ($this->herbarium->wasChanged('altitude'))
                $arrChanged['altitude'] = $model->altitude." > ".$this->herbarium->altitude;
            if ($this->herbarium->wasChanged('habit'))
                $arrChanged['habit'] = $model->habit." > ".$this->herbarium->habit;
            if ($this->herbarium->wasChanged('frequency'))
                $arrChanged['frequency'] = $model->frequency." > ".$this->herbarium->frequency;
            if ($this->herbarium->wasChanged('micro_habitat'))
                $arrChanged['micro_habitat'] = $model->micro_habitat." > ".$this->herbarium->micro_habitat;
            if ($this->herbarium->wasChanged('forest'))
                $arrChanged['forest'] = $model->forest." > ".$this->herbarium->forest;
            if ($this->herbarium->wasChanged('phenology'))
                $arrChanged['phenology'] = $model->phenology." > ".$this->herbarium->phenology;
            if ($this->herbarium->wasChanged('quantity_main'))
                $arrChanged['quantity_main'] = $model->quantity_main." > ".$this->herbarium->quantity_main;
            if ($this->herbarium->wasChanged('quantity_duplicate'))
                $arrChanged['quantity_duplicate'] = $model->quantity_duplicate." > ".$this->herbarium->quantity_duplicate;
            if ($this->herbarium->wasChanged('quantity_lent'))
                $arrChanged['quantity_lent'] = $model->quantity_lent." > ".$this->herbarium->quantity_lent;
            if ($this->herbarium->wasChanged('description'))
                $arrChanged['description'] = $model->description." > ".$this->herbarium->description;
            if ($this->herbarium->wasChanged('association'))
                $arrChanged['association'] = $model->association." > ".$this->herbarium->association;
            if ($this->herbarium->wasChanged('leaf'))
                $arrChanged['leaf'] = $model->leaf." > ".$this->herbarium->leaf;
            if ($this->herbarium->wasChanged('flower'))
                $arrChanged['flower'] = $model->flower." > ".$this->herbarium->flower;
            if ($this->herbarium->wasChanged('fruit'))
                $arrChanged['fruit'] = $model->fruit." > ".$this->herbarium->fruit;
            if ($this->herbarium->wasChanged('seeds'))
                $arrChanged['seeds'] = $model->seeds." > ".$this->herbarium->seeds;
            if ($this->herbarium->wasChanged('notes'))
                $arrChanged['notes'] = $model->notes." > ".$this->herbarium->notes;
            
            //$arrChanged['collection_number'] = $this->herbarium->collection_number;

            activity()
                ->performedOn($model)
                ->withProperties($arrChanged)
                ->log('Plant details updated for collection number '.$this->herbarium->collection_number);            
        }
    }   
    
}
