<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLogs extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'role',
        'checked_in',
        'date_created'
    ];
    public $timestamps=false;
}
