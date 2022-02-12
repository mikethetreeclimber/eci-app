<?php

namespace Modules\Crm\Imports;

use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Station;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Crm\Entities\Customers;
use Modules\Crm\Http\Livewire\Services\AddressSanitizer;

class MailingListImport implements ToModel, WithHeadingRow
{
    public $circuitId;

    public function __construct(Circuit $circuit)
    {
        $this->circuitId = $circuit->id;
    }

    public function model(array $row)
    {
        return new Customers([
            'circuit_id' => $this->circuitId,
            'title' => $row['title'],
            'work_order' => $row['work_order'],
            'first_name' => $row['firstname'],
            'last_name' => $row['lastname'],
            'mailing_address' => AddressSanitizer::sanitize($row['mailing_address']),
            'city' => $row['city'],
            'state' => $row['state'],
            'physical_address' => AddressSanitizer::sanitize($row['physical_address']),
            'physical_city' => $row['physical_city'],
            'physical_state' => $row['physical_state'],
            'station_name' => $row['station_name'],
            'unit' => $row['unit'],
            'permission_status' => $row['permission_status'],
            'assessed_date' => $row['assessed_date'],
        ]);
    }
}
