<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacts extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Crm\Database\factories\ContactsFactory::new();
    // }
}
