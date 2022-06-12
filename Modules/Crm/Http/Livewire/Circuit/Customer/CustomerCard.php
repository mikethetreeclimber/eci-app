<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;

class CustomerCard extends Component
{
    public $customer;
    public $circuit;
    public $modal = false;


    public function mount(Customers $customer)
    {
        $this->customer = $customer;
    }

    public function approve()
    {
        $this->customer->update([
            'permission_status' => 'Approved'
        ]);
    }
    
    public function render()
    {
        dd($this->customer);
        return view('crm::livewire.circuit.customer.customer-card');
    }
}
