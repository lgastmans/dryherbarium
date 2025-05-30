<?php

namespace App\Livewire;

use App\Models\Herbarium;
use App\Models\Family;
use App\Models\Genus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;

use PowerComponents\LivewirePowerGrid\PowerGrid;
//use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;

use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
//use Spatie\LaravelPdf\Facades\Pdf;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Contracts\View\View;


final class HerbariumTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'herbarium';

    public string $primaryKey = 'herbarium.id';

//    public string $sortField = 'families.family, genuses.name'; 
    public string $sortField = 'collection_number';
    public string $sortDirection = 'asc';
    //public bool $withSortStringNumber = true;

    public bool $multiSort = true;

    public bool $onlyWithImages = false;

    protected $queryString = [];


    public function setUp(): array
    {

//        $this->persist(['columns', 'filters'], prefix: auth()->id ?? '');       

        $this->showCheckBox();

        /*
        DB::enableQueryLog(); // Enable query logging
        // Listen for queries and log them
        DB::listen(function ($query) {
            Log::info("SQL: " . $query->sql, ['bindings' => $query->bindings, 'time' => $query->time]);
        });
        */

        if (Auth::check()) {
            return [
                Exportable::make(fileName: 'dry-herbarium')
                    ->striped()
                    ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                    ->columnWidth([
                        1 => 50,
                        2 => 80,
                        3 => 40,
                        4 => 25,
                        5 => 25,
                        6 => 20
                    ]),
                Header::make()->showSearchInput(),
                Footer::make()
                    ->showPerPage(perPage: 50, perPageValues: [25, 50, 100, 0]),
            ];
        }
        else {
            return [
                Header::make()->showSearchInput(),
                Footer::make()
                    ->showRecordCount()
                    ->showPerPage(perPage: 50, perPageValues: [25, 50, 100, 0]),
            ];
        }

    }

    public function datasource(): Builder
    {
        //return Herbarium::query()->with('family');

        //return Herbarium::query()
        $query = Herbarium::query()
            ->join('families', function ($families) {
                $families->on('herbarium.family_id', '=', 'families.id');
            })
            ->leftjoin('places', function ($places) {
                $places->on('herbarium.place_id', '=', 'places.id');
            })
            ->join('genus', function ($genus) {
                $genus->on('herbarium.genus_id', '=', 'genus.id');
            })
            
            ->leftjoin('collectors as c1', function ($collector1){
                $collector1->on('herbarium.collector1_id', '=', 'c1.id');
            })
            ->leftjoin('collectors as c2', function ($collector2){
                $collector2->on('herbarium.collector2_id', '=', 'c2.id');
            })
            ->leftjoin('collectors as c3', function ($collector3){
                $collector3->on('herbarium.collector3_id', '=', 'c3.id');
            })
            ->selectRaw("herbarium.*, families.family, genus.name AS genus_name, places.name AS place_name");

            /*
            ->selectRaw("
                herbarium.*, families.family, genus.name AS genus_name, places.name AS place_name,
                CONCAT_WS(', ', CONCAT(c1.name, ' ', c1.surname), CONCAT(c2.name, ' ', c2.surname), CONCAT(c3.name, ' ', c3.surname)) AS collected_by
            ");
            */
        
        if ($this->onlyWithImages) {
            $query->whereHas('images'); // Only rows where images exist
        }

        return $query;

    }

    public function relationSearch(): array
    {
        return [
            'family' => [ // relationship on family model
                'family', // column enabled to search
            ],
            'genus' => [ // relationship on genus model
                'name', // column enabled to search
            ], 
            'place' => [
                'name'
            ]
        ];
    }

    public function header(): array
    {
        if (Auth::check()) {
            return [
                Button::add('herbarium-save')
                    ->slot('Add plant')
                    ->class('text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80')
                    ->route('plants.create', []),
                    // ->openModal('projects-save', []),
                // Button::add('download-labels')
                //     ->slot('Download Labels')
                //     ->dispatch('download-labels', []),
            ];
        }
            return [];
    }    

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('family')
            ->add('genus_name')
            //->add('family', fn ($herbarium) => e($herbarium->family->family))
            //->add('family_id')
            //->add('place_id')
            //->add('taluk_id')
            //->add('district_id')
            //->add('state_id')
            //->add('genus_id')
            //->add('status_id')
            //->add('collector1_id')
            //->add('collector2_id')
            //->add('collector3_id')
            //->add('specific_id')
            ->add('collection_number')
            ->add('herbarium_number')
            ->add('vernacular_name')
            ->add('quantity_main')
            ->add('quantity_duplicate')
            ->add('quantity_lent')
            ->add('notes')
            ->add('collected_on_formatted', fn (Herbarium $model) => Carbon::parse($model->collected_on)->format('d/m/Y'))
            ->add('collected_by')
            ->add('coordinates', fn(Herbarium $model) => ($model->latitude."<br>".$model->longitude))
            ->add('latitude')
            ->add('longitude')
            ->add('altitude')
            ->add('habit')
            ->add('description')
            ->add('association')
            ->add('frequency')
            ->add('micro_habitat')
            ->add('leaf')
            ->add('phenology')
            ->add('flower')
            ->add('fruit')
            ->add('seeds')
            ->add('forest')
            ->add('created_at')
            ->add('place_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->hidden(),

            Column::make('Family', 'family', 'families.family')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('Genus', 'genus_name', 'genus.name')
                ->sortable()
                ->searchable(['query' => null])
                ->visibleInExport(visible: true),

            Column::make('Place', 'place_name', 'places.name')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('Collection<br>number', 'collection_number')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('Herbarium<br>number', 'herbarium_number')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: false),

            Column::make('Vernacular name', 'vernacular_name')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Qty<br>main', 'quantity_main')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('Qty<br>duplicate', 'quantity_duplicate')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Qty<br>lent', 'quantity_lent')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Notes', 'notes')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Collected on', 'collected_on_formatted', 'collected_on')
                ->sortable()
                ->visibleInExport(visible: true),

            Column::make('Collected By', 'collected_by'),

            Column::make('Coordinates', 'coordinates', 'coordinates')
                ->visibleInExport(visible: true),

            Column::make('Latitude', 'latitude')
                ->hidden(),

            Column::make('Longitude', 'longitude')
                ->hidden(),

            Column::make('Altitude', 'altitude')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Habit', 'habit')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Association', 'association')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Frequency', 'frequency')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Micro habitat', 'micro_habitat')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Leaf', 'leaf')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Phenology', 'phenology')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Flower', 'flower')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Fruit', 'fruit')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Seeds', 'seeds')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Forest', 'forest')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->hidden(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->hidden(),
                //->hidden(!Auth::check()),


            //Column::action('Action')->hidden(!Auth::check())
            Column::action('Action')
                ->visibleInExport(visible: false)
                ->title('<div wire:ignore><button id="toggleImagesBtn" wire:click="filterWithImages" class="ml-2 bg-red-500 text-white px-2 py-1 rounded">Only Images</button></div>')
        ];
    }

    public function filters(): array
    {
        
        return [
            Filter::inputText('genus_name', 'genus.name'),
                //->operators(['contains', 'is', 'is_not', 'is_blank', 'is_not_blank']),
            Filter::select('family', 'family_id')
                //->dataSource(Family::all()->orderBy('family', 'desc'))
                ->dataSource(Family::query()->orderBy('family', 'asc')->get())
                ->optionLabel('family')
                ->optionValue('id'),
            Filter::inputText('place_name', 'places.name'),
            Filter::inputText('collection_number')
                ->placeholder('Collection Number'),
            Filter::datepicker('collected_on')
            
            /*
            Filter::inputText('collected_by', 'collected_by')
                ->builder(function ($query, $searchTerm) {
                    \Log::info('Filter Input:', ['type' => gettype($searchTerm), 'value' => $searchTerm]);
                    
                    // Ensure $searchTerm is an array
                    if (!is_array($searchTerm)) {
                        \Log::error("Unexpected searchTerm format:", ["searchTerm" => $searchTerm]);
                        return []; //$query; // Prevent crash
                    }

                    // Extract actual search value
                    $searchText = $searchTerm['value'] ?? '';

                    // Make sure it's a string
                    if (!is_string($searchText)) {
                        \Log::error("Search term value is not a string:", ["value" => $searchText]);
                        return []; $query; // Prevents crash
                    }

                    \Log::info("Filtering Collected By:", ["searchText" => $searchText]);

                    // Fix: Ensure we're not passing a string where an array is expected
                    return $query->where(function ($q) use ($searchText) {
                        $q->whereRaw("CONCAT(c3.name, ' ', c3.surname) LIKE ?", ["%$searchText%"])
                          ->orWhereRaw("CONCAT(c2.name, ' ', c2.surname) LIKE ?", ["%$searchText%"])
                          ->orWhereRaw("CONCAT(c1.name, ' ', c1.surname) LIKE ?", ["%$searchText%"]);
                    });
                })
            */
            
        ];
    
        //return [];
    }


    #[\Livewire\Attributes\On('export-pdf')]
    public function exportPdf($id) 
    {

        $herbarium = Herbarium::find($id);

        $data = [
            'title' => 'Herbarium',
            'address' => 'Auroville, Tamil Nadu, India',
            'herbarium' => $herbarium,
        ];

        $pdf = Pdf::loadView('herbarium-label', $data);
        // return $pdf->download('herbarium-label.pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'herbarium-label-'.$herbarium->collection_number.'.pdf');

        /**
         * to open the label in a new window use the line below
         */
        //$this->js('window.open("/herbarium-label/'.$id.'","_blank");');        
    }

    #[\Livewire\Attributes\On('download-labels')]
    public function downloadLabels() 
    {
        $this->js('download-labels');
    }

    public function actions(Herbarium $row): array
    {

        if (count($row->images) > 0)
            $svg = '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                        <circle cx="18" cy="6" r="7" fill="green"/>
                        <text x="18" y="10" font-family="Arial" font-size="11" text-anchor="middle" fill="white">'.count($row->images).'</text>
                    </svg>';
        else
            $svg = '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>';


        if (Auth::check()) {
            return [
                Button::make('edit', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                               </svg>')
                    ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500')
                    ->route('plants.update', ['herbarium' => $row]),

                Button::make('destroy', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>')
                    ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                    ->openModal('delete-plant', ['id' => $row->id]),

                Button::make('pdf', '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                        </svg>')
                    ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                    ->dispatch('export-pdf', ['id' => $row->id]),
                    //->route('herbarium-label', ['id' => $row->id]),

                Button::make('images', $svg)
                    ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                    ->openModal('view-herbarium-image', ['herbarium' => $row]),                    

            ];
        }
        else
            return [];
    }

    public function actionRules(): array
    {
        return [];
        /*
        return [
            Rule::button('images')
                ->when(fn(Herbarium $herbarium) => $herbarium->images->count() <= 0)
                ->hide()
        ];
        */
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshTable',
            ]
        );
    }

    public function refreshTable(): void
    {
        $this->dispatch('pg:eventRefresh-default');
    }

    #[On('genus-replaced')] 
    public function notifyGenusReplaced()
    {
        //$this->js('alert("This '.$Model.' cannot be deleted - it is present in herbarium collection number: "+'.$ColNum.')');
        //$this->js(' $dispatch("openModal", { component: "alert-herbarium", arguments: { Model: "'.$Model.'", ColNum: "'.$ColNum.'"} }); ');
        session()->flash('status', 'Genus successfully replaced');
    }


    #[On('filterWithImages')] 
    public function filterWithImages()
    {
        $this->onlyWithImages = !$this->onlyWithImages;

        $this->dispatch('toggle-images-filter-updated', 
            label: $this->onlyWithImages ? 'Show All' : 'Only Images',
            color: $this->onlyWithImages ? 'bg-green-500' : 'bg-red-500'
        );        
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
