<div class="p-6 m-6">
    <form wire:submit="save">

        <section class="bg-white dark:bg-gray-900">

            <div class="grid gap-4 mb-4 sm:grid-cols-12 sm:gap-6 sm:mb-5">

                <div class="sm:col-span-12">
                    <x-input wire:model="name" label="Edit genus" placeholder="Genus" />
                </div>
                
            </div>
            <br>
            <x-button label="Save" positive lg green icon="save" type="submit" class="p-4"/>       

        </section>

    </form>

</div>
