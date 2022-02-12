<?php

namespace Modules\Crm\Http\Livewire\Services;

use Illuminate\Support\Str;


class AddressSanitizer 
{
    public static function sanitize ($address)
    {
        return static::sanitizeStreetSuffix(static::sanitizeStreetName($address));
    }

    protected static function sanitizeStreetSuffix($address)
    {
        if (Str::contains(strtoupper($address), 'AVENUE')) {
            return Str::replace('AVENUE', 'AVE', strtoupper($address));
        }
        if (Str::contains(strtoupper($address), 'STREET')) {
            return Str::replace('STREET', 'ST', strtoupper($address));
        }  
        if (Str::contains(strtoupper($address), 'DRIVE')) {
            return Str::replace('DRIVE', 'DR', strtoupper($address));
        }
        if (Str::contains(strtoupper($address), 'ROAD')) {
            return Str::replace('ROAD', 'RD', strtoupper($address));
        }
        return $address;
    }

    protected static function sanitizeStreetName($address)
    {
        if (Str::contains(strtoupper($address), 'FIRST')) {
            return Str::replace('FIRST', '1ST', $address);
        }
        if (Str::contains(strtoupper($address), 'SECOND')) {
            return Str::replace('SECOND', '2ND', $address);
        }
        if (Str::contains(strtoupper($address), 'THIRD')) {
            return Str::replace('THIRD', '3RD', $address);
        }
        if (Str::contains(strtoupper($address), 'FOURTH')) {
            return Str::replace('FOURTH', '4TH', $address);
        }
        if (Str::contains(strtoupper($address), 'FIFTH')) {
            return Str::replace('FIFTH', '4TH', $address);
        }
        if (Str::contains(strtoupper($address), 'FOURTH')) {
            return Str::replace('FOURTH', '5TH', $address);
        }
        if (Str::contains(strtoupper($address), 'SIXTH')) {
            return Str::replace('SIXTH', '6TH', $address);
        }
        if (Str::contains(strtoupper($address), 'SEVENTH')) {
            return Str::replace('SEVENTH', '7TH', $address);
        }
        if (Str::contains(strtoupper($address), 'EIGHTH')) {
            return Str::replace('EIGHTH', '8TH', $address);
        }
        if (Str::contains(strtoupper($address), 'NINTH')) {
            return Str::replace('NINTH', '9TH', $address);
        }
        if (Str::contains(strtoupper($address), 'TENTH')) {
            return Str::replace('TENTH', '10TH', $address);
        }
        if (Str::contains(strtoupper($address), 'ELEVENTH')) {
            return Str::replace('ELEVENTH', '11TH', $address);
        }
        if (Str::contains(strtoupper($address), 'TWELFTH')) {
            return Str::replace('TWELFTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'THIRTEENTH')) {
            return Str::replace('THIRTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'FOURTEENTH')) {
            return Str::replace('FOURTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'FIFTEENTH')) {
            return Str::replace('FIFTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'SIXTEENTH')) {
            return Str::replace('SIXTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'SEVENTEENTH')) {
            return Str::replace('SEVENTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'EIGHTEENTH')) {
            return Str::replace('EIGHTEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'NINETEENTH')) {
            return Str::replace('NINETEENTH', '12TH', $address);
        }
        if (Str::contains(strtoupper($address), 'TWENTIETH')) {
            return Str::replace('TWENTIETH', '12TH', $address);
        }
        return $address;
    }
    
}