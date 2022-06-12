<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Modules\Crm\Imports\ContactListImport;

class ImportContactList extends Component
{
    Use WithFileUploads;

    public $contacts;
    // public $workOrder;

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
        // Artisan::call('queue:work'); 
        Excel::import(new ContactListImport(), $file);
        $this->notify('Contact list is Importing');
    }

    // public function searchWorkOrder() 
    // {
    //     dd(shell_exec(public_path('/PPL_ECIMailingList_WO.exe')));
    // }

    public function render()
    {
        return view('livewire.import-contact-list');
    }
}
