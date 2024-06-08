<div>
    <x-card title="Delete specific">

        <p class="text-sm text-gray-500">Are you sure you want to delete this specific?</p>
     
        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="Cancel" secondary wire:click="$dispatch('closeModal')"/>
                <x-button label="Delete" negative icon="document-remove" wire:click="delete" />
            </div>
        </x-slot>
    </x-card>
</div>
