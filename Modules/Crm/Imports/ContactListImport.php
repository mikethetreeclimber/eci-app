<?php

namespace Modules\Crm\Imports;

use Modules\Crm\Entities\Circuit;
use Illuminate\Support\Collection;
use Modules\Crm\Entities\Contacts;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ContactListImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {
            return new Contacts([
                'customer_id' => null,
                'region' => $row['region'],
                'feeder_id' => $row['feeder_id'],
                'substation_name' => $row['substation_name'],
                'customer_name' => $row['customer_name'],
                'service_address' => 
                    preg_replace('/\b , \b/', ', ',
                        preg_replace('/\s+/', ' ',
                            trim($row['service_address']))),
                'mailing_address' => 
                    preg_replace('/\b , \b/', ', ',
                        preg_replace('/\s+/', ' ',
                            trim($row['mailing_address']))),
                'primary_phone' => $row['primary_phone'],
                'alt_phone' => $row['alt_phone'],
                'email_address' => $row['email_address'],
                'revenue_class_desc' => $row['revenue_class_desc']
            ]);
        
    }

    // public function batchSize(): int
    // {
    //     return 50;
    // }

// TODO: FIgure out how to que file import to imprt large files
    public function chunkSize(): int
    {
        return 1000;
    }
}
