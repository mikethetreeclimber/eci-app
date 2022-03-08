<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;
use Modules\Crm\Entities\Permission;

class CustomerPermissions extends Component
{
    public $circuit;
    public $customer;
    public $permissions;
    public $attempt_type;
    public $attempt_notes;
    public $attempt_number;
    public $permissionsCount;
    public $addAttemptModal = false;

    protected $rules = [
        'attempt_number' => 'required',
        'attempt_type' => 'required', 
        'attempt_notes' => 'required'
    ];

    public function mount()
    {
        $this->customer->permissions->whenNotEmpty(function () {
            $this->permissions = $this->customer->permissions->sortDesc();
        });

        $this->customer->permissions->whenEmpty(function () {
            $this->permissions = [];
        });
        $this->permissionsCount = count($this->permissions);
        $this->attempt_number = $this->permissionsCount + 1;
    }

    public function submit()
    {

        $data = $this->validate();
        $data['circuit_id'] = $this->circuit->id;
        $data['user_id'] = auth()->id();
        $data['customer_id'] = $this->customer->id;

        Permission::create($data);

        $this->customer = Customers::find($this->customer->id);
        $this->permissions = $this->customer->permissions->sortDesc();
        $this->addAttemptModal = false;
    }

    public function addAttempt()
    {
        $this->addAttemptModal = true;
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-permissions');
    }
}
