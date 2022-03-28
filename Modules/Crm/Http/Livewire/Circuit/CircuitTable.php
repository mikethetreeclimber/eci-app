<?php

namespace Modules\Crm\Http\Livewire\Circuit;

use Livewire\Component;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;

class CircuitTable extends Component
{
    public $circuit;
    public $circuits;
    public $confirmDestroyCircuit = false;
    protected $listeners = [
        'refreshCircuitTable' => '$refresh'
    ];

    public function mount()
    {
        $this->checkForCircuits();
    }

    public function checkForCircuits()
    {
        $this->circuits = Circuit::where('user_id', '=', auth()->id())
        ->orderBy('created_at', 'DESC')
        // ->restore();
        ->get()->toArray();
    }

    public function confirmDelete(Circuit $circuit)
    {
        $this->confirmDestroyCircuit = true;
        $this->circuit = $circuit;
    }

    public function delete()
    {
        $this->confirmDestroyCircuit = false;
        Customers::where('circuit_id', $this->circuit->id)->delete();
        Circuit::destroy($this->circuit->id);
        $this->checkForCircuits();
    }

    public function render()
    {
        return view('crm::livewire.circuit.circuit-table');
    }
}
