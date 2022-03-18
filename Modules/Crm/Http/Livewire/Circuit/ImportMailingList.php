<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Illuminate\Bus\Batch;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
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
use Modules\Crm\Jobs\Contacts\ImportContactsJob;

class ImportMailingList extends Component
{
    use WithFileUploads, WithPagination;

    public Circuit $circuit;
    public $mailing;
    public $contacts;
    public $search = '';
    public $searchBy = 'last_name';
    public $orderBy = 'last_name';
    // public $orderDirection = 'DE';
    public $paginate = 5;
    public $customersCount;
    public $importingContacts;
    public $permissionStatus = '';
    public $importing;
    public $confirmDestroyCustomers = false;
    protected $allCustomers;

    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function updatedPaginate() { $this->resetPage(); }
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
        return view('crm::livewire.circuit.import-mailing-list', [
            'customers' => Customers::where('circuit_id', '=', $this->circuit->id)
                ->where('permission_status', $this->permissionStatus)
                ->search($this->searchBy, $this->search)
                ->orderBy($this->orderBy)
                ->paginate($this->paginate),
        ]);
    }
}
