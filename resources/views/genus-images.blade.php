<x-app-layout>

    <div class="py-12 px-24">

        <form action="/images" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" required>
            <button type="submit">Upload</button>
        </form>

        <div class="grid">
            @foreach ($images as $image)
                <img src="{{ asset('photos/' . $image->path) }}" alt="Image">
            @endforeach
        </div>

    </div>

</x-app-layout>