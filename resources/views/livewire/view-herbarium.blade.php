{{--

    Eventually this component could show the main details of a herbarium collection

--}}

<div class="relative w-full max-w-7xl max-h-full p-6">

    <div class="p-5">
        <h5 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $herbarium->genus->name }}</h5>
        <p class="mb-3 text-xl font-normal text-gray-700 dark:text-gray-400 text-center">{{ $herbarium->family->family }}</p>
    </div>


    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    
    <div class="grid grid-cols-1 7xl:grid-cols-1 gap-4">
        @foreach($images as $image)
            <div>
                <a href="#">
                    <img class="h-auto max-w-full rounded-lg border-1" src="{{ asset('herbarium/'.$image->filename) }}" wire:click="$dispatch('openImageModal', { component: 'view-herbarium-image', arguments: { imageUrl: '{{ $image->filename }}' }})" title="" alt="">
            </div>
        @endforeach
    </div>

</div>


