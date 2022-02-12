<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;
use Modules\Crm\Entities\Circuit;

class CreateCircuitForm extends Component
{
    public $circuit_name;
    public $city;

    protected $rules = [
        'circuit_name' => 'required',
        'city' => 'required'
    ];

    public function submit()
    {
      $this->validate();
      
      Circuit::create([
          'circuit_name' => str_replace(' ', '-', ucwords($this->circuit_name)),
          'city' => strtoupper($this->city),
          'user_id' => auth()->id()
      ]);

        session()->flash('flash.banner', 'Circuit Successfully Added');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirectRoute('crm.index');
    }
    public function render()
    {
        return view('crm::livewire.circuit.create-circuit-form');
    }
}
