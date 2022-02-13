<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;

class PossibleContactsList extends Component
{
    public $fuzzySearchSent;
    public $possibleContacts;

    protected $listeners = [
        'possibleContacts'
    ];
    
    public function possibleContacts($possibleContacts)
    {
        // dd($possibleContacts);
        $this->possibleContacts = $possibleContacts;
        $this->fuzzySearchSent = true;
        $this->emit('searchReceived');
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.possible-contacts-list');
    }
}
