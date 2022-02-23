<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Bus;
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
    public $importingContacts;
    public $permissionStatus = '';
    public $importedAts;
    protected $allCustomers;

    public function mount()
    {
        // $this->setCustomers();
    }



    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function destroyCustomers()
    {
        $customers = Customers::where('circuit_id', '=', $this->circuit->id)
            ->where('imported_at', '=', collect($this->customers)->first()['imported_at'])->delete();

        $this->getCustomers();
    }

    public function setImportedAts()
    {
        $this->importedAts = collect($this->customers)->unique('imported_at')->pluck('imported_at')->flatten()->toArray();
    }

    public function setCustomers()
    {
        $this->allCustomers = collect(
            Customers::where('circuit_id', '=', $this->circuit->id)
                ->orderBy('imported_at', 'DESC')
                ->get()
        );

        $this->getCustomers();
    }

    public function getCustomers()
    {
        $this->setImportedAts();
        $this->customers = collect($this->allCustomers)
            ->unique('last_name')
            // ->where('imported_at', $this->importedAts[0])
            // ->where('permission_status', $this->permissionStatus)
            // ->orWhere('permission_status', '=', '')
            ->values()->all();

        // $this->setImportedAt();




        // dd($this->importedAts);
        // TODO: add filtering
        // if ($this->blankPermissions !== true ) {
        // $this->customers = collect(
        //     Customers::where('circuit_id', '=', $this->circuit->id)->orderBy('permission_status')
        //         ->get()
        // )->unique('last_name')->values()->all();
        // } else {
        //     $this->customers = collect(
        //         Customers::where('circuit_id', '=', $this->circuit->id)->where('permission_status', '=', '')
        //             ->get()
        //     )->unique('last_name')->values()->all();
        // }

    }

    public function updatedMailing()
    {
        $file = Storage::put('/public', $this->mailing);
        Excel::import(new MailingListImport($this->circuit), $file);

        $this->getCustomers();
    }

    public function updatingContacts($value)
    {
        Validator::make(
            ['contacts' => $value],
            ['contacts' => 'required|mimes:xls,xlsx'],
        )->validate();
    }
    // TODO: seperate to own component
    public function updatedContacts()
    {
        $file = Storage::put('/public', $this->contacts);
        // ImportContactsJob::dispatch($file);
        Excel::import(new ContactListImport(), $file);
        // // sleep(5);
        // session()->flash('flash.banner', 'Contacts Successfully Added');
        // session()->flash('flash.bannerStyle', 'success');
        // $this->redirectRoute('crm.show', ['circuit' => $this->circuit]);

    }


    public function render()
    {
        $this->customers =  collect(Customers::where('circuit_id', '=', $this->circuit->id)
                ->orderBy('last_name', 'DESC')
                ->get())->unique('last_name')
                ->where('permission_status', $this->permissionStatus)
                ->values()->all();

        return view('crm::livewire.circuit.import-mailing-list', [
            'customers' => $this->customers,
        ]);
    }
}
