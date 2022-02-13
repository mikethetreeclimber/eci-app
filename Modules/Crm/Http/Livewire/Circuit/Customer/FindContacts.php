<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Fuse\Fuse;
use Livewire\Component;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\Customers;
use Modules\Crm\Http\Livewire\Services\AddressSanitizer;

class FindContacts extends Component
{
    public $customer;
    public $circuit;
    public $fuzzySearchComplete = false;
    public $possibleContacts = [];

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
        $contacts = collect(Contacts::get(['customer_name', 'service_address', 'primary_phone', 'alt_phone']))->flatten()->toArray();
        $fuseAddress  = new Fuse($contacts, $addressOptions);
        $fuzzyAddressSearch = $fuseAddress->search($this->customer->service_address);

        $fuseName  = new Fuse($contacts, $nameOptions);
        $fuzzyNameSearch = $fuseName->search($this->customer->name);
        if ($fuzzyNameSearch !== []) {
            foreach ($fuzzyNameSearch as $search) {
                $this->possibleContacts['byName'][] =  $search['item'];
            }
        } else {
            $this->possibleContacts['byName'] = [];
        }

        if ($fuzzyAddressSearch !== []) {
            foreach ($fuzzyAddressSearch as $search) {
                $this->possibleContacts['byAddress'][] =  $search['item'];
            }
        } else {
            $this->possibleContacts['byAddress'] = [];
        }

        if ($this->possibleContacts['byAddress'] !== [] && $this->possibleContacts['byName'] !== []) {
            foreach ($this->possibleContacts['byAddress'] as $byAddress) {
                foreach ($this->possibleContacts['byName'] as $byName) {
                    if ($byAddress['service_address'] === $byName['service_address']) {
                        $this->possibleContacts['bestResults'][] = $byName;
                    }
                }
            }
        } elseif ($this->possibleContacts['byName'] !== []) {
            foreach ($this->possibleContacts['byName'] as $byName) {
                $this->possibleContacts['bestResults'][] = $byName;
            }
        } elseif ($this->possibleContacts['byAddress'] !== []) {
            foreach ($this->possibleContacts['byAddress'] as $byAddress) {
                $this->possibleContacts['bestResults'][] = $byAddress;
            }
        };
        $this->fuzzySearchComplete = false;
        sleep(1);
        $this->emit('possibleContacts', $this->possibleContacts);
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.find-contacts');
    }
}
