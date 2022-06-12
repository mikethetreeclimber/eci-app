<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;

class CustomerDetails extends Component
{
    public $circuit;
    public $customer;
    public $stationData;
    
    protected $listeners = [
        'refreshCustomerDetails' => '$refresh',
    ];

    protected $rules = [
        'stationData.*.permission_status'
    ];
    
    // public function approveAll($unit)
    // {
    //    dd($this->stationData->toArray()[$unit]);
    // }

    public function setPermissionStatus(Customers $station)
    {
        if ($station->permission_status === '') {
            $station->update([
                'permission_status' => 'Approved'
            ]);
        } elseif ($station->permission_status === 'Approved') {
            $station->update([
                'permission_status' => ''
            ]);
        }

        $this->emit('refreshCustomerDetails');
        $this->emit('refreshCustomerHeader');
    }

    public function render()
    {
        $stationData = Customers::select('id', 'station_name', 'unit', 'permission_status')
        ->where('circuit_id', $this->circuit->id)
        ->where('first_name', $this->customer->first_name)
        ->where('last_name', $this->customer->last_name)
        ->where('mailing_address', $this->customer->mailing_address)
        ->where('city', $this->customer->city)
        ->where('state', $this->customer->state)
        ->get();

        $this->stationData = collect($stationData)->groupBy('unit');

        dd($this->customer);
        return view('crm::livewire.circuit.customer.customer-details', compact('stationData'));
    }
}
