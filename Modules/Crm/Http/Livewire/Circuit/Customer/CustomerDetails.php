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
    ];

    protected $rules = [
        'stationData.*.permission_status'
    ];
    
    public function render()
    {
        $stationData = Customers::select('station_name', 'unit', 'permission_status')
        ->where('first_name', 'LIKE', '%'.$this->customer->first_name.'%')
        ->where('last_name', 'LIKE', '%'.$this->customer->last_name.'%')
        ->where('physical_address', 'LIKE', '%'.$this->customer->physical_address.'%')
        ->where('physical_city', 'LIKE', '%'.$this->customer->physical_city.'%')
        ->where('physical_state', 'LIKE', '%'.$this->customer->physical_state.'%')
        ->get();

        $this->stationData = collect($stationData)->groupBy('unit');

        return view('crm::livewire.circuit.customer.customer-details', compact('stationData'));
    }
}
