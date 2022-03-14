<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;

class CustomerDetails extends Component
{
    public $customer;
    public $stationData;
    
    protected $listeners = [
        'refreshCustomerDetails' => '$refresh',
        'refreshCustomerDetails' => 'stationDataGetter'
    ];

    public function stationDataGetter()
    {
        $this->stationData = Customers::select('station_name', 'unit')
        ->where('first_name', 'LIKE', '%'.$this->customer->first_name.'%')
        ->where('last_name', 'LIKE', '%'.$this->customer->last_name.'%')
        ->where('physical_address', 'LIKE', '%'.$this->customer->physical_address.'%')
        ->where('physical_city', 'LIKE', '%'.$this->customer->physical_city.'%')
        ->where('physical_state', 'LIKE', '%'.$this->customer->physical_state.'%')
        ->get();
    }
    
    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-details');
    }
}
