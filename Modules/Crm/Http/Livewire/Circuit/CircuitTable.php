<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;
use Modules\Crm\Entities\Circuit;

class CircuitTable extends Component
{
    public $circuits;

    public function mount()
    {
        $this->checkForCircuits();
    }

    public function checkForCircuits()
    {
        $this->circuits = Circuit::where('user_id', '=', auth()->id())
        ->orderBy('created_at', 'DESC')
        ->get()->toArray();
    }

    public function archive(Circuit $circuit)
    {
        Circuit::destroy($circuit->id);
        $this->checkForCircuits();
    }

    public function render()
    {
        return view('crm::livewire.circuit.circuit-table');
    }
}
