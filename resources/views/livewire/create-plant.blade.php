
<div class="p-1 m-1">

    <form wire:submit="save" enctype="multipart/form-data">

        <x-errors />

        <section class="bg-white dark:bg-gray-900">

            <div class="max-w-6xl px-4 py-8 mx-auto lg:py-16">

                <h2 class="mb-4 py-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-4xl dark:text-white">
                    <span class="underline underline-offset-3 decoration-4 decoration-blue-400 dark:decoration-blue-600">{{$form->family}} {{ empty($form->family) ? "" : "|" }} {{ $form->genus }}</span>
                </h2>

                <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">

                    <div class="sm:col-span-1">
                        <x-input wire:model="form.collection_number" label="Collection number" placeholder="Collection number" />
                    </div>

                    <div class="sm:col-span-1">
                        <x-datetime-picker 
                            wire:model="form.collected_on" 
                            label="Collected On" 
                            placeholder="Collected On" 
                            without-time="true"
                            display_format="D-MMM-YYYY"
                        />
                    </div>

                    <div class="sm:col-span-1">
                        <x-select
                            label="Family"
                            wire:model="form.family_id"
                            placeholder="Select a family"
                            :async-data="route('ajax.families')"
                            option-label="family"
                            option-value="id"
                            selected="{{$form->family}}"
                        />
                    </div>
                  
                    <div class="sm:col-span-3">
                        <x-select
                            label="Genus"
                            wire:model="form.genus_id"
                            placeholder="Select a genus"
                            :async-data="route('ajax.genus')"
                            option-label="name"
                            option-value="id"
                            selected="{{$form->genus}}"
                        />
                    </div>
                </div>


                {{--
                    Buttons: Save and Cancel
                --}}
                <br>
                <x-button label="Save" positive lg green icon="save" type="submit" class="p-4"/>
                <x-button label="Cancel" error lg red icon="x" class="p-4" wire:click="cancel" />
                @if (!empty($form->id))
                <x-button label="Label" teal lg icon="document-text" class="p-4" wire:click="label" />
                @endif
                <br><br>


                {{--
                    Tabs
                --}}
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="detail-tab" data-tabs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="false">Details</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="texts-tab" data-tabs-target="#texts" type="button" role="tab" aria-controls="texts" aria-selected="false">Texts</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="notes-tab" data-tabs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false">Notes</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="images-tab" data-tabs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">Images</button>
                        </li>
                    </ul>
                </div>
                <div id="default-tab-content">

                    {{--
                        Details
                    --}}
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="detail" role="tabpanel" aria-labelledby="detail-tab">

                        <div class="grid gap-4 mb-4 sm:grid-cols-4 sm:gap-6 sm:mb-5">

                            <div class="sm:col-span-2">
                                <x-input wire:model="form.vernacular_name" label="Vernacular Name" placeholder="Vernacular Name" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-input wire:model="form.herbarium_number" label="Herbarium number" placeholder="Herbarium number" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-select
                                    label="Place"
                                    wire:model="form.place_id"
                                    placeholder="Select a place"
                                    :async-data="route('ajax.places')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->place}}"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <x-select
                                    label="Taluk"
                                    wire:model="form.taluk_id"
                                    placeholder="Select a taluk"
                                    :async-data="route('ajax.taluks')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->taluk}}"
                                />
                            </div>

                            <div class="sm:col-span-2">
                                <x-select
                                    label="District"
                                    wire:model="form.district_id"
                                    placeholder="Select a district"
                                    :async-data="route('ajax.districts')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->district}}"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <x-select
                                    label="State"
                                    wire:model="form.state_id"
                                    placeholder="Select a state"
                                    :async-data="route('ajax.states')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->state}}"
                                />
                            </div>

                            <div class="sm:col-span-1">
                                <x-input wire:model="form.latitude" label="Latitude" placeholder="Latitude" hint="Alt+0176 for ° (degree symbol)" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.longitude" label="Longitude" placeholder="Longitude" hint="Alt+0176 for ° (degree symbol)" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.altitude" label="Altitude" placeholder="Altitude" />
                            </div>
                            <div class="sm:col-span-1">
                            </div>

                            <div class="sm:col-span-1">
                                <x-input wire:model="form.habit" label="Habit" placeholder="Habit" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.frequency" label="Frequency" placeholder="Frequency" />
                            </div>
                            <div class="sm:col-span-2">
                                <x-select
                                    label="Specific"
                                    wire:model="form.specific_id"
                                    placeholder="Select a specific"
                                    :async-data="route('ajax.specifics')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->specific}}"
                                />
                            </div>

                            <div class="sm:col-span-1">
                                <x-input wire:model="form.micro_habitat" label="Habitat" placeholder="Habitat" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.forest" label="Forest" placeholder="Forest" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-select
                                    label="Status"
                                    wire:model="form.status_id"
                                    placeholder="Select a status"
                                    :async-data="route('ajax.statuses')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->status}}"
                                />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.phenology" label="Phenology" placeholder="Phenology" />
                            </div>


                            <div class="sm:col-span-1">
                                <x-input wire:model="form.quantity_main" label="Qty Main" placeholder="Qty Main" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.quantity_duplicate" label="Qty Duplicate" placeholder="Qty Duplicate" />
                            </div>
                            <div class="sm:col-span-1">
                                <x-input wire:model="form.quantity_lent" label="Qty Lent" placeholder="Qty Lent" />
                            </div>
                            <div class="sm:col-span-1">
                            </div>

                            <div class="sm:col-span-1">
                                <x-select
                                    label="Collector"
                                    wire:model="form.collector1_id"
                                    placeholder="Select a collector"
                                    :async-data="route('ajax.collectors')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->collector1}}"
                                />
                            </div>
                            <div class="sm:col-span-1">
                                <x-select
                                    label="Collector"
                                    wire:model="form.collector2_id"
                                    placeholder="Select a collector"
                                    :async-data="route('ajax.collectors')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->collector2}}"
                                />
                            </div>
                            <div class="sm:col-span-1">
                                <x-select
                                    label="Collector"
                                    wire:model="form.collector3_id"
                                    placeholder="Select a collector"
                                    :async-data="route('ajax.collectors')"
                                    option-label="name"
                                    option-value="id"
                                    selected="{{$form->collector3}}"
                                />
                            </div>


                        </div>
                    </div>

                    {{--
                        Texts
                    --}}
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="texts" role="tabpanel" aria-labelledby="texts-tab">
                        
                        <div class="grid gap-4 mb-4 sm:grid-cols-3 sm:gap-6 sm:mb-5">

                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.description" label="Description" placeholder="Description" rows="6"/>
                            </div>
                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.association" label="Association" placeholder="Association" rows="6"/>
                            </div>
                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.leaf" label="Leaf" placeholder="Leaf" rows="6"/>
                            </div>

                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.flower" label="Flower" placeholder="Flower" rows="6"/>
                            </div>
                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.fruit" label="Fruit" placeholder="Fruit" rows="6"/>
                            </div>
                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.seeds" label="Seeds" placeholder="Seeds" rows="6"/>
                            </div>

                        </div>                        
                    </div>

                    {{--
                        Notes
                    --}}
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                        <div class="grid gap-4 mb-4 sm:grid-cols-1 sm:gap-6 sm:mb-5">

                            <div class="sm:col-span-1">
                                <x-textarea wire:model="form.notes" label="Notes" placeholder="Notes" rows="10"/>
                            </div>
                            
                        </div>   
                    </div>

                    @if (isset($form->images))
                    {{--
                        Images
                    --}}
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="images" role="tabpanel" aria-labelledby="images-tab">

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($form->images as $image)
                                <div>
                                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('herbarium/'.$image->filename) }}" alt="">
                                </div>
                            @endforeach
                        </div>

                    </div>
                    @endif

                </div>

            </div>

        </section>

    </form>

</div>