<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'qr',
        'email',
        'fname',
        'lname',
        'minitial',
        'extension',
        'bday',
        'address',
        'phone_number',
        'telephone_number',
        'age',
        'date_employed',
        'sex',
        'city',
        'region',
        'postal_code',
        'country',
        'nationality',
        'position',
        'status',
    ];
    public $timestamps=false;
}
