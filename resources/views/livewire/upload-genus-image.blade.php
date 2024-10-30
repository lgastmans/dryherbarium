<div>

    {{-- <img src="{{ asset('photos/testing.jpg') }}" /> --}}

    <form wire:submit="save">

        <input type="hidden" value="{{$genus_id}}" wire:model="genus_id" />

        <div class="grid gap-4 mb-4 grid-cols-2">

            <div class="col-span-4">
                <input type="file" wire:model="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
             
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
         
            <div class="col-span-2">
                <x-button label="Upload" positive md blue icon="save" type="submit" class="p-4"/>  
            </div>

            <div class="col-span-6"></div>

        </div>

    </form>


     

</div>
