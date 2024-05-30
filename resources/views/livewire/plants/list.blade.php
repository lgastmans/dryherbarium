<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On; 

new class extends Component {
    
    public Collection $plants;
 
    public function mount(): void
    {
        $this->getPlants(); 
    }

    #[On('plant-created')]
    public function getChirps(): void
    {
        $this->plants = Plant::latest()
            ->get();
    } 

}; ?>

<div>
    <livewire:plant-table />
</div>
