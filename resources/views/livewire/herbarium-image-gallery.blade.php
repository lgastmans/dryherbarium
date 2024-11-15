<div>
    <!-- Modal for full-width image display -->
    @if($selectedImage)
      <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
        <div class="relative">
          <img src="{{ $selectedImage }}" alt="Full-size image" class="max-w-full max-h-full rounded">
          <button class="absolute top-2 right-2 text-white text-2xl" wire:click="closeModal">&times;</button>
        </div>
      </div>
    @endif
</div>
