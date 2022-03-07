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
        // dd($possibleContacts);
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

    public function searchBestResults()
    {
        $this->searchBy = 'bestResults';
        $this->possibleContacts($this->allContacts);
        
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
            if ($this->allPossibleContacts[$this->searchBy] !== []) {
                $this->searchBy = $this->searchBy;
            } else {
                $this->searchBy = 'byName';
            } 
            $possibleContacts = $this->allPossibleContacts[$this->searchBy];

        } else {
            $possibleContacts = [];
        }
        return view('crm::livewire.circuit.customer.possible-contacts-list', [
            'possibleContacts' => $possibleContacts
        ]);
    }
}
