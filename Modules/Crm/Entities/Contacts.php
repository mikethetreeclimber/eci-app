<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        "region",
        "feeder_id",
        "substation_name",
        "customer_name",
        "service_address",
        "mailing_address",
        "primary_phone",
        "alt_phone",
        "email_address",
        "revenue_class_desc",
        "created_at",
        "updated_at",
    ];
}
