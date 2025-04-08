<x-app-layout>

    <div class="py-12 px-24">
        
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Herbarium</h1>

        <livewire:herbarium-table/>

    </div>

</x-app-layout>

<script>
    window.addEventListener('toggle-images-filter-updated', event => {

        const button = document.getElementById('toggleImagesBtn');
        
        if (button) {
            button.innerText = event.detail.label;
            button.classList.remove('bg-green-500', 'bg-red-500');
            button.classList.add(event.detail.color);
        }
    });
</script>