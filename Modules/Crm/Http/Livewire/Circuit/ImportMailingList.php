<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Crm\Imports\ContactListImport;
use Modules\Crm\Imports\MailingListImport;

class ImportMailingList extends Component
{
    use WithFileUploads, WithPagination;

    public $mailing;
    public $contacts;
    public $importing;
    public $search = '';
    public $paginate = 5;
    public $customersCount;
    public Circuit $circuit;
    public $importingContacts;
    public $permissionStatus = '';
    public $orderBy = 'last_name';
    public $searchBy = 'last_name';
    public $orderDirection = 'ASC';
    public $confirmDestroyCustomers = false;

    public $searchables = [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'station_name' => 'Station Name',
        'unit' => 'Unit',
        'mailing_address' => 'Mailing Address',
        'physical_address' => 'Physical Address'
    ];

    protected $queryString = [
        'paginate',
        'searchBy',
        'search',
    ];

    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function updatedPaginate() { $this->resetPage(); }
    public function updatedSearch() { $this->resetPage(); }
    
    public function confirmDestroyCustomers()
    {
        $this->confirmDestroyCustomers = true;
    }

    public function destroyCustomers()
    {
        Customers::where('circuit_id', '=', $this->circuit->id)->delete();
            
        $this->confirmDestroyCustomers = false;
    }

    public function updatedMailing()
    {
        $file = Storage::put('/public', $this->mailing);
        Excel::import(new MailingListImport($this->circuit), $file);
    }

    public function updatingContacts($value)
    {
        Validator::make(
            ['contacts' => $value],
            ['contacts' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function updatedContacts()
    {
        $file = Storage::put('/public', $this->contacts);
        Excel::import(new ContactListImport(), $file);
    }

    public function render()
    {
        if ( $this->permissionStatus === 'Show All') {
            $customers = Customers::where('circuit_id', '=', $this->circuit->id)
                ->search($this->searchBy, $this->search)
                ->orderBy($this->orderBy, $this->orderDirection)
                ->paginate($this->paginate);
        } else {
            $customers = Customers::where('circuit_id', '=', $this->circuit->id)
                ->where('permission_status', $this->permissionStatus)
                ->search($this->searchBy, $this->search)
                ->orderBy($this->orderBy, $this->orderDirection)
                ->paginate($this->paginate);
        }

        $customerCount = Customers::where('circuit_id', '=', $this->circuit->id)
                ->count();
        return view('crm::livewire.circuit.import-mailing-list', compact('customers', 'customerCount'));
    }
}
