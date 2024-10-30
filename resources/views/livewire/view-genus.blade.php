<div class="relative p-4 w-full max-h-full">

    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

        <div class="p-5">
            <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $genus->name }}</h5>
        </div>

        <livewire:upload-genus-image :genus_id="$id" />

        <div class="table-responsive">
            <livewire:genus-images-table :genus_id="$id" />
        </div>

    </div>
    
</div>



