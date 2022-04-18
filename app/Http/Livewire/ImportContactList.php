<?php

namespace App\Http\Livewire;

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
        return view('livewire.import-contact-list');
    }
}
