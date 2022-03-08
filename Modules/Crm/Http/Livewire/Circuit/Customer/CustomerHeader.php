<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;
use Illuminate\Support\Facades\Http;
use Modules\Crm\Entities\PhoneFinder;
use Modules\Crm\Http\Livewire\Circuit\Services\PhoneNumberFormattor;


class CustomerHeader extends Component
{
    public $circuit;
    public $customer;
    public $editModal = false;
    public $refusalModal = false;
    public $approvalModal = false;
    public $noContactModal = false;
    public $notApprovedModal = false;

    protected $rules = [
        'customer.first_name' => 'required',
        'customer.last_name' => 'required',
        'customer.mailing_address' => 'required',
        'customer.city' => 'required',
        'customer.state' => 'required',
        'customer.physical_address' => 'required',
        'customer.physical_city' => 'required',
        'customer.physical_state' => 'required',
    ];

    public function mount()
    {
        // dd($this->customer);
    }

    public function approve()
    {
        $this->customer->update([
            'permission_status' => 'Approved'
        ]);

        $this->approvalModal = false;
    }

    public function refusal()
    {
        $this->customer->update([
            'permission_status' => 'Refusal'
        ]);

        $this->refusalModal = false;
    }

    public function notApproved()
    {
        $this->customer->update([
            'permission_status' => ''
        ]);

        $this->notApprovedModal = false;
    }

    public function noContact()
    {
        $this->customer->update([
            'permission_status' => 'No Contact'
        ]);

        $this->noContactModal = false;
    }

    public function editCustomer()
    {
        $this->customer->push();
        
        $this->editModal = false;
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-header');
    }
}
