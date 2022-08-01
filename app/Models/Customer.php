<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'lastName',
        'firstName',
        'middleName',
        'contactNumber',
        'floor_unit',
        'streetAddress',
        'province',
        'city_municipality',
        'barangay',
        'zipCode',
    ];
}
