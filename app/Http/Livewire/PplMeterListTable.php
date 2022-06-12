<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Modules\Crm\Entities\Contacts;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PplMeterListTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Detail::make()
                ->view('components.ppl-meter-list-details')
                ->options(['name' => 'region']),
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\Modules\Crm\Entities\Contacts>
     */
    public function datasource(): Builder
    {
        return Contacts::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('region')
            ->addColumn('feeder_id')
            ->addColumn('substation_name')
            ->addColumn('customer_name')
            ->addColumn('service_address')
            ->addColumn('mailing_address')
            ->addColumn('primary_phone')
            ->addColumn('alt_phone')
            ->addColumn('email_address');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [

            Column::make('REGION', 'region')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(true, false),

            Column::make('CUSTOMER NAME', 'customer_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PRIMARY PHONE', 'primary_phone')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(),

            Column::make('ALT PHONE', 'alt_phone')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(),

            Column::make('EMAIL ADDRESS', 'email_address')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(),

            Column::make('SERVICE ADDRESS', 'service_address')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('MAILING ADDRESS', 'mailing_address')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(true, false),

            Column::make('SUBSTATION NAME', 'substation_name')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->hidden(true, false),
        ];
    }

    public function actions(): array
    {
        return [
            //    Button::make('edit', 'Edit')
            //        ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            //        ->route('contacts.edit', ['contacts' => 'id']),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('contacts.destroy', ['contacts' => 'id'])
            //        ->method('delete')

            Button::add('toggle-detail')
                ->caption('Details')
                ->class('cursor-pointer block bg-green-500 text-white p-1')
                ->toggleDetail(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Contacts Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Contacts Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($contacts) => $contacts->id === 1)
                ->hide(),
        ];
    }
    */
}
