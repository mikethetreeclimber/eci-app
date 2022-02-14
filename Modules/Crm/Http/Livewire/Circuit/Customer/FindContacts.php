<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Fuse\Fuse;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\Customers;
use Illuminate\Support\Facades\Http;
use Modules\Crm\Entities\PhoneFinder;
use Modules\Crm\Http\Livewire\Services\AddressSanitizer;

class FindContacts extends Component
{
    public $customer;
    public $circuit;
    public $phoneFinder;
    public $fuzzySearchComplete = false;
    public $possibleContacts = [
        'byName' => [],
        'byAddress' => [],
        'bestResults' => []
    ];

    protected $listeners = [
        'searchReceived'
    ];

    public function searchReceived()
    {
        $this->fuzzySearchComplete = true;
    }

    public function fuzzySearch()
    {
        $this->fuzzySearchComplete = true;
        $addressOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['service_address'],
        ];
        $nameOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['customer_name'],
        ];

        $contactsByName = Contacts::select()->where('customer_name', 'LIKE','%'.$this->customer->last_name)->get();
        $contactsByAddress = Contacts::select()->where('service_address', 'LIKE', '%'.$this->customer->physical_address.'%' )
            ->orWhere('mailing_address', 'LIKE', '%'.$this->customer->mailing_address.'%')
            ->get();
            
        $fuseAddress  = new Fuse($contactsByAddress->flatten()->toArray(), $addressOptions);
        $fuzzyAddressSearch = $fuseAddress->search($this->customer->service_address);

        $fuseName  = new Fuse($contactsByName->flatten()->toArray(), $nameOptions);
        $fuzzyNameSearch = $fuseName->search($this->customer->name);
        if ($fuzzyNameSearch !== []) {
            foreach ($fuzzyNameSearch as $search) {
                $this->possibleContacts['byName'][] =  $search['item'];
            }
        } 

        if ($fuzzyAddressSearch !== []) {
            foreach ($fuzzyAddressSearch as $search) {
                $this->possibleContacts['byAddress'][] =  $search['item'];
            }
        } 

        if ($this->possibleContacts['byAddress'] !== [] && $this->possibleContacts['byName'] !== []) {
            foreach ($this->possibleContacts['byAddress'] as $byAddress) {
                foreach ($this->possibleContacts['byName'] as $byName) {
                    if ($byAddress['service_address'] == $byName['service_address']) {
                        $this->possibleContacts['bestResults'][] = $byName;
                    }
                    if ($byAddress['service_address'] !== $byName['service_address']) {
                        $this->possibleContacts['bestResults'][] = $byAddress;
                        $this->possibleContacts['bestResults'][] = $byName;
                    }
                }
            }
        } 
        if ($this->possibleContacts['byAddress'] !== [] && $this->possibleContacts['byName'] == []) {
            foreach ($this->possibleContacts['byAddress'] as $byAddress) {
                $this->possibleContacts['bestResults'][] = $byAddress;

            }
        } 
        if ($this->possibleContacts['byName'] !== [] && $this->possibleContacts['byAddress'] == []) {
            foreach ($this->possibleContacts['byName'] as $byName) {
                $this->possibleContacts['bestResults'][] = $byName;
            }
         };
// dd($this->possibleContacts);
        $this->fuzzySearchComplete = false;
        sleep(1);
        $this->emit('possibleContacts', $this->possibleContacts);
    }

    

    

    public function render()
    {
        return view('crm::livewire.circuit.customer.find-contacts');
    }
}
