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
use Modules\Crm\Http\Livewire\Services\AddressSanitizer;

class ImportMailingList extends Component
{
    use WithFileUploads, WithPagination;

    public $mailingListUpload;
    public $contacts;
    public $importing;
    public $search = '';
    public $paginate = 5;
    public $customersCount;
    public Circuit $circuit;
    public $importingContacts;
    public $permissionStatus = '';
    public $orderBy = 'station_name';
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
        'permissionStatus',
        'orderBy',
        'paginate',
        'searchBy',
        'search',
    ];

    protected $listeners = [
        'setMailing' => 'setMailing',
        'refreshCustomerList' => '$refresh'
    ];

    // public function updatingMailing($value)
    // {
    //     Validator::make(
    //         ['mailingListUpload' => $value],
    //         ['mailingListUpload' => 'required|mimes:xls,xlsx'],
    //     )->validate();
    // }

    public function updatedPaginate()
    {
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDestroyCustomers()
    {
        $this->confirmDestroyCustomers = true;
    }

    public function destroyCustomers()
    {
        Customers::where('circuit_id', '=', $this->circuit->id)->delete();

        $this->confirmDestroyCustomers = false;
    }

    public function setMailing($uploadedMailingList)
    {
        // $this->mailingListUpload = $uploadedMailingList;
        foreach ($uploadedMailingList as $key => $array) {
            foreach ($array as $key => $row) {
                if ($row['LASTNAME'] !== null && $row['MAILING ADDRESS'] !== null) {
                    Customers::create([
                        'circuit_id' => $this->circuit->id,
                        'title' => $row['Title'],
                        'work_order' => $row['Work Order'],
                        'first_name' => $row['FIRSTNAME'],
                        'last_name' => $row['LASTNAME'],
                        'mailing_address' => AddressSanitizer::sanitize($row['MAILING ADDRESS']),
                        'city' => $row['CITY'],
                        'state' => $row['STATE'],
                        'physical_address' => AddressSanitizer::sanitize($row['PHYSICAL ADDRESS']),
                        'physical_city' => $row['PHYSICAL CITY'],
                        'physical_state' => $row['PHYSICAL STATE'],
                        'station_name' => $row['Station Name'],
                        'unit' => $row['Unit'],
                        'permission_status' => ucwords($row['Permission Status']),
                        'assessed_date' => $row['Assessed Date'],
                        'imported_at' => NULL
                    ]);
                }
            }
        }

        $this->emit('refreshCustomerList');


       
    }

    public function updatedMailingListUpload() 
    {

        $importedAt = now();
        foreach ($this->mailingListUpload as $key => $array) {
            foreach ($array as $key => $row) {
                if ($row['LASTNAME'] !== null && $row['MAILING ADDRESS'] !== null) {
                    Customers::create([
                        'circuit_id' => $this->circuit->id,
                        'title' => $row['Title'],
                        'work_order' => $row['Work Order'],
                        'first_name' => $row['FIRSTNAME'],
                        'last_name' => $row['LASTNAME'],
                        'mailing_address' => AddressSanitizer::sanitize($row['MAILING ADDRESS']),
                        'city' => $row['CITY'],
                        'state' => $row['STATE'],
                        'physical_address' => AddressSanitizer::sanitize($row['PHYSICAL ADDRESS']),
                        'physical_city' => $row['PHYSICAL CITY'],
                        'physical_state' => $row['PHYSICAL STATE'],
                        'station_name' => $row['Station Name'],
                        'unit' => $row['Unit'],
                        'permission_status' => ucwords($row['Permission Status']),
                        'assessed_date' => $row['Assessed Date'],
                        'imported_at' => $importedAt
                    ]);
                }
            }
        }

         // $file = Storage::put('/public', $this->mailingListUpload);
        // Excel::import(new MailingListImport($this->circuit), $file);
        // $this->mailing->delete();
        // $file = Storage::put('/public', $this->mailing);
        // Excel::import(new MailingListImport($this->circuit),  $this->mailing->get());
    }

    public function render()
    {
        if ($this->permissionStatus === 'Show All') {
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
