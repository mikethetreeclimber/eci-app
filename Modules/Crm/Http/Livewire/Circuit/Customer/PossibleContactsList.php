<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;

class PossibleContactsList extends Component
{
    public $fuzzySearchSent;
    public $allContacts;
    public $possibleContacts;
    public $searchBy = 'bestResults';

    protected $listeners = [
        'possibleContacts'
    ];
    
    public function possibleContacts($possibleContacts)
    {
        $this->allContacts = $possibleContacts;
        $this->possibleContacts = $possibleContacts[$this->searchBy];
        $this->fuzzySearchSent = true;
        $this->emit('searchReceived');
    }

    public function searchByName()
    {
        $this->searchBy = 'byName';
        $this->possibleContacts($this->allContacts);
        
    }

    public function searchBestResults()
    {
        $this->searchBy = 'bestResults';
        $this->possibleContacts($this->allContacts);
        
    }
    public function render()
    {
        return view('crm::livewire.circuit.customer.possible-contacts-list');
    }
}
