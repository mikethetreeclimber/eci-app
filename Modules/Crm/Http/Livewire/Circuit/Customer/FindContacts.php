<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Fuse\Fuse;
use Illuminate\Support\ViewErrorBag;
use Livewire\Component;
use Modules\Crm\Entities\Contacts;

class FindContacts extends Component
{
    public $customer;
    public $circuit;
    public $phoneFinder;
    public $searchBy = 'physical_address';
    public $search = 'service_address';

    public $fuzzySearchComplete = false;
    public $possibleContacts = [
        'byName' => [],
        'byAddress' => [],
    ];

    protected $listeners = [
        'searchReceived'
    ];

    public function searchReceived()
    {
        $this->fuzzySearchComplete = true;
    }


    // Physical Address is from the customers table 
    // Service Address is from the contacts table
    public function fuzzySearch()
    {
        $this->possibleContacts = [
            'byName' => [],
            'byAddress' => [],
        ];

        $this->fuzzySearchComplete = true;

        $addressOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['service_address', 'mailing_address'],
        ];
        $nameOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['customer_name'],
        ];

        $contactsByName = Contacts::search('customer_name', $this->customer->last_name)->get();

        if ($this->searchBy === 'physical_address') {
            if (preg_match('~[0-9]+~', $this->customer->physical_address)) {
                $contactsByAddress = Contacts::search($this->search,  $this->customer->physical_address)
                    ->search($this->search,  $this->customer->physical_city)
                    ->search($this->search,  $this->customer->physical_state)
                    ->get();
            } else {
                $contactsByAddress = null;
                $this->addError('invalidSearch', 'The address must have a valid house number and a valid street to use the search function');
                return;
            }
        }

        if ($this->searchBy === 'mailing_address') {
            if (preg_match('~[0-9]+~', $this->customer->mailing_address)) {
                $contactsByAddress = Contacts::search($this->search, $this->customer->mailing_address)
                    ->search($this->search,  $this->customer->city)
                    ->search($this->search,  $this->customer->state)
                    ->get();
            } else {
                $contactsByAddress = null;
                $this->addError('invalidSearch', 'The address must have a valid house number and a valid street to use the search function');
                return;
            }
        }


        if ($contactsByAddress !== null) {
            $fuseAddress  = new Fuse(
                $contactsByAddress->flatten()->toArray(),
                $addressOptions
            );
            if ($this->searchBy === 'mailing_address') {
                $fuzzyAddressSearch = $fuseAddress->search($this->customer->mailing_address);
            } elseif ($this->searchBy === 'physical_address') {
                $fuzzyAddressSearch = $fuseAddress->search($this->customer->physical_address);
            }
        } else {
            $fuzzyAddressSearch = [];
        }

        $fuseName  = new Fuse(
            $contactsByName->flatten()->toArray(),
            $nameOptions
        );
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


        if (isset($this->possibleContacts)) {
            $this->emit('possibleContacts', $this->possibleContacts);
        }
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.find-contacts');
    }
}
