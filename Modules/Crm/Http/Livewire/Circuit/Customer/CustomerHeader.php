<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;


class CustomerHeader extends Component
{
    public $circuit;
    public $customer;
    public $unitsToApprove;
    public $editModal = false;
    public $refusalModal = false;
    public $customerRowsToUpdate;
    public $approvalModal = false;
    public $noContactModal = false;
    public $notApprovedModal = false;

    protected $rules = [
        'customer.first_name' => 'present',
        'customer.last_name' => 'present',
        'customer.mailing_address' => 'present',
        'customer.city' => 'present',
        'customer.state' => 'present',
        'customer.physical_address' => 'present',
        'customer.physical_city' => 'present',
        'customer.physical_state' => 'present',
    ];

    protected $listeners = [
        'refreshCustomerHeader' => '$refresh'
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

    public function pplApprove()
    {
        $this->customer->update([
            'permission_status' => 'PPL Approved'
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
        $data = $this->validate();
         
        $this->customerRowsToUpdate->toQuery()->update([
            'first_name' => $data['customer']['first_name'],
            'last_name' => $data['customer']['last_name'],
            'mailing_address' => $data['customer']['mailing_address'],
            'city' => $data['customer']['city'],
            'state' => $data['customer']['state'],
            'physical_address' => $data['customer']['physical_address'],
            'physical_city' => $data['customer']['physical_city'],
            'physical_state' => $data['customer']['physical_state'],
        ]);

        $this->editModal = false;

        $this->emit('refreshCustomerDetails');
    }

    public function render()
    {
        $this->customerRowsToUpdate = Customers::where('first_name', $this->customer->first_name)
            ->where('last_name', $this->customer->last_name)
            ->where('mailing_address', $this->customer->mailing_address)
            ->where('physical_address', $this->customer->physical_address)
            ->get();

        return view('crm::livewire.circuit.customer.customer-header');
    }
}
