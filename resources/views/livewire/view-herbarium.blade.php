<div class="relative w-full max-w-7xl max-h-full p-6">

    <div class="p-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $herbarium->genus->name }}</h5>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">{{ $herbarium->family->family }}</p>
    </div>

{{--
    <dl class="grid grid-cols-3 7xl:grid-cols-3 gap-4 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Collection Number</dt>
            <dd class="text-lg font-semibold">{{ $herbarium->collection_number }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Place</dt>
            <dd class="text-lg font-semibold">{{ $herbarium->place->name }}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Habit</dt>
            <dd class="text-lg font-semibold">{{ $herbarium->habit }}</dd>
        </div>
    </dl>
--}}

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

{{--<div class="grid grid-cols-3 7xl:grid-cols-3 gap-4"> --}}
    
    <div class="grid grid-cols-1 7xl:grid-cols-1 gap-4">
        @foreach($images as $image)
            <div>
                <a href="#">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('photos/'.$image->filename) }}" wire:click="$dispatch('openImageModal', { component: 'view-herbarium-image', arguments: { imageUrl: '{{ $image->filename }}' }})" title="" alt="">
            </div>
        @endforeach
    </div>

</div>


