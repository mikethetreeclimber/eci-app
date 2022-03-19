<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Fuse\Fuse;
use Livewire\Component;
use Modules\Crm\Entities\Contacts;

class CustomerBestResults extends Component
{
    public $customer;
    public $bestResults = [];
    public $hasVerifiedContacts = false;
    protected $listeners = [
        'bestResultsSearchDone' => '$refresh'
    ];

    public function bestResultsSearch()
    {
        if ($this->customer->verifiedContact === null) {

            $nameOptions = [
                'ignoreLocation' => true,
                'threshold' => 0.4,
                'includeScore' => true,
                'keys' => ['customer_name'],
            ];

            $contactsByAddress = [];

            if (preg_match('~[0-9]+~', $this->customer->physical_address)) {
                $contactsByAddress[] = Contacts::select()
                    ->where('service_address', 'LIKE', '%' . $this->customer->physical_address . '%')
                    ->get();
            }

            if (preg_match('~[0-9]+~', $this->customer->mailing_address)) {
                $contactsByAddress[] = Contacts::select()
                    ->where('mailing_address', 'LIKE', '%' . $this->customer->mailing_address . '%')
                    ->get();
            }

            if (!preg_match('~[0-9]+~', $this->customer->mailing_address) && !preg_match('~[0-9]+~', $this->customer->physical_address)) {
               $this->bestResults = null;
               return;
            }

            $fuseNameAndAddress  = new Fuse(
                collect($contactsByAddress)->flatten()->toArray(),
                $nameOptions
            );

            $fuzzySearch = $fuseNameAndAddress->search($this->customer->last_name);

            if ($fuzzySearch === []) {
                $this->bestResults = null;
            } else {
                $this->bestResults = $fuzzySearch[0]['item'];
            }

        } else {
            $this->hasVerifiedContacts = true;
            $this->bestResults = [];
        }

    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-best-results');
    }
}
