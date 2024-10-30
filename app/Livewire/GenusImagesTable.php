<?php

namespace App\Livewire;

use App\Models\GenusImage;
use Livewire\Attributes\On; 
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

use PowerComponents\PowerGrid\Components\Columns\Image;


final class GenusImagesTable extends PowerGridComponent
{
    use WithExport;

    public $genus_id = null;

    public function setUp(): array
    {
        //$this->showCheckBox();

        /*
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
        */

        return [];
    }

    public function datasource(): Builder
    {
        return GenusImage::query()
            ->where('genus_id', '=', $this->genus_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('genus_id')
            //->add('filename')
            ->add('filename', fn ($item) => '<img class="h-auto max-w-md rounded-lg" src="' . asset('photos/'.$item->filename) . '">')
            ->add('created_at');                        
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(),

            Column::make('Genus id', 'genus_id')
                ->hidden(),

            Column::make('Filename', 'filename')
                ->title(''),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->hidden(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::action('Action')
                ->title('')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(GenusImage $row): array
    {
        return [
            Button::make('destroy', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>')
                ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                ->openModal('delete-genus-image', ['id' => $row->id]),

            // Button::add('edit')
            //     ->slot('Edit: '.$row->id)
            //     ->id()
            //     ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
            //     ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    #[On('refreshGenusImageTable')]
    public function refreshGenusImageTable(): void
    {
        $this->dispatch('pg:eventRefresh-default');
    }

/*
    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshGenusImageTable',
            ]
        );
    }
*/
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
