<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $fillable=[
        'student_id',
        'qr',
        'fname',
        'lname',
        'mname',
        'extension',
        'fetcher',
        'level',
        'section',
        'enroll_status',
        'bday',
        'age',
        'date_enrolled',
        'address',
        'city',
        'region',
        'postal_code',
        'country',
        'nationality',
        'sex',
        'telephone_number',
        'mobile_number',
    ];
    public $timestamps=false;
}
