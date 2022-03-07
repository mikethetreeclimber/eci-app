<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;

class CustomerPermissions extends Component
{
    public $customer;

    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-permissions');
    }
}
