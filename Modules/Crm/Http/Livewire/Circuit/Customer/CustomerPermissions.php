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
    public $noVerifiedContacts = false;

    protected $rules = [
        'attempt_number' => 'required',
        'attempt_type' => 'required', 
        'attempt_notes' => 'required'
    ];

    protected $listeners = [
        'refreshSelf' => '$refresh'
    ];

    public function mount()
    {
        $this->permissionCount();
    }

    public function permissionCount()
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

    public function addVerifiedContact()
    {
        $this->emit('verify', 'new');
        $this->noVerifiedContacts = false;
    }

    public function submit()
    {
        $data = $this->validate();
        $data['circuit_id'] = $this->circuit->id;
        $data['user_id'] = auth()->id();
        $data['customer_id'] = $this->customer->id;

        Permission::updateOrCreate($data);

        $this->customer = Customers::find($this->customer->id);
        $this->permissions = $this->customer->permissions->sortDesc();
        $this->permissionCount();
        $this->reset(['attempt_type', 'attempt_notes']);
        $this->addAttemptModal = false;
    }

    public function remove(Permission $permission)
    {
        $permission->delete();
        $this->customer = Customers::find($this->customer->id);
        $this->permissions = $this->customer->permissions->sortDesc();
        $this->permissionCount();
        $this->emit('refreshSelf');
    }

    public function edit(Permission $permission)
    {
        $this->attempt_notes = $permission->attempt_notes;
        $this->attempt_number = $permission->attempt_number;
        $this->attempt_type = $permission->attempt_type;
        $this->addAttempt();
        
    }

    public function addAttempt()
    {

        if ($this->customer->verifiedContact !== null) {
            $this->addAttemptModal = true;
        } else {
            $this->noVerifiedContacts = true;
        }
    }

    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-permissions');
    }
}
