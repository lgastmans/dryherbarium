<div>

    <x-card title="Delete plant">

        <p class="text-sm text-gray-500">Are you sure you want to delete this plant?</p>
        <p class="text-sm text-gray-500">All of the data will be permanently removed.</p>
        <p class="text-sm text-gray-500">This action cannot be undone.</p>
     
        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="Cancel" secondary wire:click="$dispatch('closeModal')"/>
                <x-button label="Delete" negative icon="document-remove" wire:click="delete" />
            </div>
        </x-slot>
    </x-card>



</div>