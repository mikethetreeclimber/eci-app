<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute($value)
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getServiceAddressAttribute($value)
    {
        return "{$this->physical_address} {$this->physical_city}, {$this->physical_state}";
    }

    public function getFullMailingAddressAttribute($value)
    {
        return "{$this->mailing_address} {$this->city}, {$this->state}";
    }
}
