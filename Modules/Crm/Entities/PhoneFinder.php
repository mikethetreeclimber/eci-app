<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneFinder extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // public function customers()
    // {
    //     return $this->hasOne(Customers::class);
    // }
}