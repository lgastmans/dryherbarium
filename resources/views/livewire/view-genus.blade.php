<div class="relative w-full max-w-7xl max-h-full p-6 m-6">

    <div class="grid grid-cols-2 7xl:grid-cols-2 gap-2">
        @foreach($images as $image)
            <div>
                <img class="h-auto max-w-full rounded-lg" src="{{ asset('Images/'.$image->filename) }}" title="" alt="">
            </div>
        @endforeach
    </div>

</div>





