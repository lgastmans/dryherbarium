<?php

namespace App\Livewire;

use App\Models\Collector;
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

use LivewireUI\Modal\ModalComponent;

final class CollectorTable extends PowerGridComponent
{

    public string $sortField = 'name'; 
    public string $sortDirection = 'asc';

    public function setUp(): array
    {
        //$this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Collector::query();
    }

    public function header(): array
    {
        return [
            Button::add('Collector-create')
                ->slot('Add Collector')
                ->class('text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80')
                ->openModal('create-collector', []),
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('surname')
            ->add('name_lower', fn (Collector $model) => strtolower(e($model->name)))
            ->add('created_at')
            ->add('created_at_formatted', fn (Collector $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable()
                ->hidden(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
                // ->editOnClick(
                //     hasPermission: auth()->check(),
                //     fallback: '- empty -',
                //     saveOnMouseOut: true
                // ),

            Column::make('Surname', 'surname')
                ->searchable()
                ->sortable(),
                // ->editOnClick(
                //     hasPermission: auth()->check(),
                //     fallback: '- empty -',
                //     saveOnMouseOut: true
                // ),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
                ->hidden(),

            Column::action('Action')
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        Collector::query()->find($id)->update([
            $field => e($value),
        ]);
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::inputText('surname'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Collector $row): array
    {
        return [
            Button::make('edit', '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                </svg>')
                ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500')
                ->dispatch('openModal', ['edit-collector', [ 'collector' => $row ]] ),

            Button::make('destroy', '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>')
                ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                ->openModal('delete-collector', ['id' => $row->id]),
        ];
    }

    #[On('collector-exists')] 
    public function notifyFamilyExists($Model, $ColNum)
    {
        //$this->js('alert("This '.$Model.' cannot be deleted - it is present in herbarium collection number: "+'.$ColNum.')');
        $this->js('
            $dispatch("openModal", { component: "alert-herbarium", arguments: { Model: "'.$Model.'", ColNum: "'.$ColNum.'"} });
        ');
    }

    #[On('refreshTable')]
    public function refreshTable(): void
    {
        $this->dispatch('pg:eventRefresh-default');
    }

    /*
    public function actionRules(Collector $row): array
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
