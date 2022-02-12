<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Modules\Crm\Imports\MailingListImport;

class ImportMailingList extends Component
{
    use WithFileUploads;

    public Circuit $circuit;
    public $mailing;
    public $customers;

    public function mount()
    {
        $this->customers = collect(
            Customers::where('circuit_id', '=', $this->circuit->id)
                ->get()
        )->unique('last_name')->values()->all();
    }

    public function updatingMailing($value)
    {
        Validator::make(
            ['mailing' => $value],
            ['mailing' => 'required|mimes:xls,xlsx'],
        )->validate();
    }

    public function updatedMailing()
    {
        $success = Excel::import(new MailingListImport($this->circuit), $this->mailing->getRealPath());

        $this->customers = collect(
            Customers::where('circuit_id', '=', $this->circuit->id)
                ->get()
        )->unique('last_name')->values()->all();
    }


    public function render()
    {
        return view('crm::livewire.circuit.import-mailing-list');
    }
}
