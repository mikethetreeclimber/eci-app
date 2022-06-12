<?php

namespace Modules\Crm\Http\Livewire\Ppl;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crm\Entities\Contacts;

class MeterListTable extends Component
{
    use WithPagination;


    public function render()
    {
    //    $regions = collect(Contacts::get('region'))->unique()->pluck('region');
    //    dd($regions);
        $PPLContacts = Contacts::paginate(6);
        return view('crm::livewire.ppl.meter-list-table', compact('PPLContacts'));
    }
}
