<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Fuse\Fuse;
use Livewire\Component;
use Modules\Crm\Entities\Contacts;

class FindContacts extends Component
{
    public $customer;
    public $circuit;
    public $phoneFinder;
    public $searchBy = 'physical_address';
    public $search = 'service_address';
    public $bestResults = [];
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

        $this->possibleContacts = [
            'byName' => [],
            'byAddress' => [],
        ];
        // dd($this->search, $this->customer->{$this->searchBy});
        $this->fuzzySearchComplete = true;
        $addressAndNameOptions = [
            'ignoreLocation' => true,
            'threshold' => 0.4,
            'includeScore' => true,
            'keys' => ['service_address', 'mailing_address', 'customer_name'],
        ];
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

        $contactsByNameAndAddress = Contacts::select()
            ->where('customer_name', 'LIKE', '%' . $this->customer->last_name)
            ->where($this->search, 'LIKE', '%' . $this->customer->{$this->searchBy} . '%')
            ->get();

        $contactsByName = Contacts::select()->where('customer_name', 'LIKE', '%' . $this->customer->last_name)->get();

        $contactsByAddress = Contacts::select()
            ->where($this->search, 'LIKE', '%' . $this->customer->{$this->searchBy} . '%')
            ->get();


        // if (!preg_match('~[0-9]+~', $this->customer->mailing_address) && preg_match('~[0-9]+~', $this->customer->physical_address)) {

        //     $contactsByNameAndAddress = Contacts::select()
        //         ->where('customer_name', 'LIKE',  '%' . $this->customer->last_name)
        //         ->where('mailing_address', 'LIKE', '%' .   $this->customer->service_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->get();

        //     $contactsByAddress = Contacts::select()
        //         ->where('service_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->orWhere('mailing_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->get();

        // } 
        // if (preg_match('~[0-9]+~', $this->customer->mailing_address) && !preg_match('~[0-9]+~', $this->customer->physical_address)) {

        //     $contactsByNameAndAddress = Contacts::select()
        //         ->where('customer_name', 'LIKE',  '%' . $this->customer->last_name)
        //         ->where('mailing_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->get();

        //     $contactsByAddress = Contacts::select()
        //         ->where('mailing_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->get();

        // } 
        // if (preg_match('~[0-9]+~', $this->customer->mailing_address) && preg_match('~[0-9]+~', $this->customer->physical_address)) {

        //     $contactsByNameAndAddress = Contacts::select()
        //         ->where('customer_name', 'LIKE',  '%' . $this->customer->last_name)
        //         ->where('mailing_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->orWhere('mailing_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->get();

        //     $contactsByAddress = Contacts::select()
        //         ->where('mailing_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->orWhere('mailing_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->service_address . '%')
        //         ->orWhere('service_address', 'LIKE', '%' . $this->customer->full_mailing_address . '%')
        //         ->get();
        // }



        $fuseNameAndAddress  = new Fuse(
            $contactsByNameAndAddress->flatten()->toArray(),
            $addressAndNameOptions
        );
        $fuzzyNameAndAddressSearch = $fuseNameAndAddress->search($this->customer->service_address);

        $fuseAddress  = new Fuse(
            $contactsByAddress->flatten()->toArray(),
            $addressOptions
        );
        $fuzzyAddressSearch = $fuseAddress->search($this->customer->service_address);

        $fuseName  = new Fuse(
            $contactsByName->flatten()->toArray(),
            $nameOptions
        );
        $fuzzyNameSearch = $fuseName->search($this->customer->name);




        if ($fuzzyNameAndAddressSearch !== []) {
            $this->bestResults =  $fuzzyNameAndAddressSearch[0]['item'];
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

        $this->fuzzySearchComplete = false;
        $this->emit('bestResultsFound', $this->bestResults);
        if (isset($this->possibleContacts)) {
            $this->emit('possibleContacts', $this->possibleContacts);
        }
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.find-contacts');
    }
}
