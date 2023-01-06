<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'gender',
        'birth_date',
        'nip',
        'blood_type',
        'phone',
        'is_active'
    ];

    protected $table = 'employee';
}
