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
    public $customers;
    public $customersCount;
    public $importingContacts;
    public $permissionStatus = '';
    public $importedAt = null;
    public $take = 3;
    public $skip = 0;
    public $importing;
    public $confirmDestroyCustomers = false;
    protected $allCustomers;
    protected $queryString = ['skip'];

    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function confirmDestroyCustomers()
    {
        $this->confirmDestroyCustomers = true;
    }

    public function destroyCustomers()
    {
        $this->setImportedAt();
        Customers::where('circuit_id', '=', $this->circuit->id)
            ->where('imported_at', '=', collect($this->customers)->first()['imported_at'])->delete();
            
        $this->confirmDestroyCustomers = false;
    }

    public function setImportedAt()
    {
        $this->importedAt = collect($this->customers)->unique('imported_at')->pluck('imported_at')->first();
    }

    public function next()
    {
        // dd($this->customersCount / 3, 24/3,  $this);
        // $this->take = $this->take += 3;
        if ($this->skip !== 0) {
            if ($this->skip > $this->customersCount) {
                $this->skip = $this->customerCount;
            } elseif ($this->skip / 3 < floor($this->customersCount / 3)) {
                $this->skip = $this->skip += 3;
            } else {
                return;
            }
        } else {
            $this->skip = $this->skip += 3;
        }
    }

    public function back()
    {
        if ($this->skip > 1) {
            $this->skip = $this->skip -= 3;
        } else {
            return;
        }
    }

    public function updatedMailing()
    {
        
        $file = Storage::put('/public', $this->mailing);
        try {
            Excel::import(new MailingListImport($this->circuit), $file);
        } catch (\Error $error) {
            $this->dangerNotify($error);
        }
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
        $this->allCustomers = Customers::where('circuit_id', '=', $this->circuit->id)
            ->when($this->importedAt !== null, function ($query) {
                return $query->where('imported_at', $this->importedAt);
            })->orderBy('last_name', 'DESC')->get();

        $this->customers =  collect($this->allCustomers)->unique('last_name')
            ->where('permission_status', 'like', $this->permissionStatus)
            ->skip($this->skip)
            ->take($this->take)
            ->values()->all();

        $this->customersCount =  collect($this->allCustomers)->unique('last_name')
            ->where('permission_status', 'like', $this->permissionStatus)
            ->count();

        return view('crm::livewire.circuit.import-mailing-list', [
            'customers' => $this->customers,
        ]);
    }
}
