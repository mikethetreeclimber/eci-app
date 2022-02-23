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
        $addressAndNameOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['service_address', 'customer_name'],
        ];
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


        $contactsByNameAndAddress = Contacts::select()
            ->where('customer_name', 'LIKE', '%' . $this->customer->last_name)
            ->where('mailing_address', 'LIKE', '%' . $this->customer->mailing_address . '%')
            ->get();

        $contactsByName = Contacts::select()->where('customer_name', 'LIKE', '%' . $this->customer->last_name)->get();
        $contactsByAddress = Contacts::select()->where('service_address', 'LIKE', '%' . $this->customer->physical_address . '%')
            ->orWhere('mailing_address', 'LIKE', '%' . $this->customer->mailing_address . '%')
            ->get();

        $fuseNameAndAddress  = new Fuse($contactsByNameAndAddress->flatten()->toArray(), $addressAndNameOptions);
        $fuzzyNameAndAddressSearch = $fuseNameAndAddress->search($this->customer->service_address);

        $fuseAddress  = new Fuse($contactsByAddress->flatten()->toArray(), $addressOptions);
        $fuzzyAddressSearch = $fuseAddress->search($this->customer->service_address);

        $fuseName  = new Fuse($contactsByName->flatten()->toArray(), $nameOptions);
        $fuzzyNameSearch = $fuseName->search($this->customer->name);

        if ($fuzzyNameAndAddressSearch !== []) {
            $bestResults =  $fuzzyNameAndAddressSearch[0]['item'];
        }
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

        // if ($this->possibleContacts['bestResults'] == []) {
        //     if ($this->possibleContacts['byAddress'] !== [] && $this->possibleContacts['byName'] == []) {
        //         $this->possibleContacts['bestResults'] = $this->possibleContacts['byAddress'];
        //     }
        //     if ($this->possibleContacts['byName'] !== []) {
        //         $this->possibleContacts['bestResults'] = $this->possibleContacts['byName'];
        //     }
        // };
        // dd($this->possibleContacts);
        $this->fuzzySearchComplete = false;
        // sleep(1);
        if (isset($bestResults)) {
            $this->emit('bestResultsFound', $bestResults);
        }else{
            $this->emit('possibleContacts', $this->possibleContacts);
        }
    }





    public function render()
    {
        return view('crm::livewire.circuit.customer.find-contacts');
    }
}
