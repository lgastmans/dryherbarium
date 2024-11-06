<div class="relative w-full max-w-7xl max-h-full p-6">

    <div class="p-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $herbarium->genus->name }}</h5>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">{{ $herbarium->family->family }}</p>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">Collection Number: {{ $herbarium->collection_number }}</p>
    </div>

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <livewire:upload-herbarium-image :herbarium_id="$herbarium->id" :genus_id="$herbarium->genus_id"/>

    <livewire:herbarium-images-table :herbarium_id="$herbarium->id" />

</div>


