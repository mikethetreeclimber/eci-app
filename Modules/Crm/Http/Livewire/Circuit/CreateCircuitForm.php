<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;

class CreateCircuitForm extends Component
{
    public $circuit_name;

    public function submit()
    {
        // dd('here');
        session()->flash('flash.banner', 'Yay for free components!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirectRoute('crm.index');
    }
    public function render()
    {
        return view('crm::livewire.circuit.create-circuit-form');
    }
}
