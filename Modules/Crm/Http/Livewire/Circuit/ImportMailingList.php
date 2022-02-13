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
    public $blankPermissions = true;

    public function mount()
    {
        $this->getCustomers();
   
    }

    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function getCustomers()
    {

        $this->customers = collect(Customers::where('circuit_id', '=', $this->circuit->id)
                ->where('permission_status', '=', '')
                ->get()
            )->unique('last_name')->filter( function( $customer ){
                    return $customer->last_name !== '';
            })->values()->all();

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
        Excel::import(new MailingListImport($this->circuit), $this->mailing->getRealPath());

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
        Excel::import(new ContactListImport(), $file);
        sleep(5);
        session()->flash('flash.banner', 'Contacts Successfully Added');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirectRoute('crm.show', ['circuit' => $this->circuit]);
        
    }


    public function render()
    {
        return view('crm::livewire.circuit.import-mailing-list');
    }
}
