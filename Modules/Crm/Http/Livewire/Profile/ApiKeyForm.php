<?php

namespace Modules\Crm\Http\Livewire\Profile;

use Livewire\Component;

class ApiKeyForm extends Component
{
    public $apiKey;

    public function mount()
    {
        if (auth()->user()->api_key !== null) {
            $this->apiKey = auth()->user()->api_key;
        } else {
            $this->apiKey = '';
        }
    }

    public function addApiKey()
    {
        $user = auth()->user();
        $user->forceFill([
            'api_key' => $this->apiKey
        ])->save();

        $this->emit('saved');
    }

    public function render()
    {
        return view('crm::livewire.profile.api-key-form');
    }
}
