<div class="relative w-full max-w-7xl max-h-full p-6">

    <div class="flex flex-row items-start p-4">
        <!-- Title on the left -->
        <div class="w-1/4 pr-4">
            <h1 class="text-2xl font-bold text-center">{{ $herbarium->genus->name }}</h1>
            <!-- <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $herbarium->genus->name }}</h5> -->
            <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">{{ $herbarium->family->family }}</p>
            <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">Collection Number: {{ $herbarium->collection_number }}</p>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        
            <livewire:upload-herbarium-image :herbarium_id="$herbarium->id" :genus_id="$herbarium->genus_id"/>
        </div>

        <!-- Images on the right -->
        <div class="w-3/4">
            <livewire:herbarium-images-table :herbarium_id="$herbarium->id" />

        </div>
    </div>

    {{--
    <div class="p-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $herbarium->genus->name }}</h5>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">{{ $herbarium->family->family }}</p>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">Collection Number: {{ $herbarium->collection_number }}</p>
    </div>

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <livewire:upload-herbarium-image :herbarium_id="$herbarium->id" :genus_id="$herbarium->genus_id"/>

    <livewire:herbarium-images-table :herbarium_id="$herbarium->id" />
    --}}

</div>


