<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;

class PossibleContactsList extends Component
{
    public $fuzzySearchSent;
    public $allContacts;
    public $allPossibleContacts;
    public $searchBy = 'byAddress';

    protected $listeners = [
        'possibleContacts'
    ];
    
    public function possibleContacts($possibleContacts)
    {
        $this->allPossibleContacts = $possibleContacts;

        $this->fuzzySearchSent = true;
        $this->emit('searchReceived');
    }

    public function setSearchBy()
    {
        if ($this->searchBy === 'byAddress') {
            $this->searchBy = 'byName';
        }elseif ($this->searchBy === 'byName') {
            $this->searchBy = 'byAddress';
        }
        
    }

    public function remove($key)
    {
        unset($this->allPossibleContacts[$this->searchBy][$key]);
    }

    public function verify()
    {
        //
    }
    
    public function render()
    {
     
        if (isset($this->allPossibleContacts)) {
         
            $possibleContacts = $this->allPossibleContacts;

        } else {
            $possibleContacts = [];
        }
        return view('crm::livewire.circuit.customer.possible-contacts-list', [
            'possibleContacts' => $possibleContacts
        ]);
    }
}
