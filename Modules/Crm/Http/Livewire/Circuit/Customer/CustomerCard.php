<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;

class CustomerCard extends Component
{
    public $customer;
    public $circuit;

    public function mount(Customers $customer)
    {
        $this->customer = $customer;
    }
    
    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-card');
    }
}
