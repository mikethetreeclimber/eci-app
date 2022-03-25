<?php

namespace Modules\Crm\Imports;

use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Station;
use Modules\Crm\Entities\Customers;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Modules\Crm\Http\Livewire\Services\AddressSanitizer;

class MailingListImport implements ToModel, WithHeadingRow
{
    public $circuitId;
    public $importStart;

    public function __construct($circuitId)
    {
        $this->circuitId = Circuit::find($circuitId)->id;
        $this->importStart = now();
    }

    public function model($row)
    {

        
        if ($row['lastname'] !== null && $row['mailing_address'] !== null) {
            Customers::create([
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
                'permission_status' => ucwords($row['permission_status']),
                'assessed_date' => $row['assessed_date'],
                'imported_at' => $this->importStart
            ]);
        }
    }

    // TODO: FIgure out how to que file import to imprt large files

    // public function chunkSize(): int
    // {
    //     , ShouldQueue, WithChunkReading
    //     return 100;
    // }
}
