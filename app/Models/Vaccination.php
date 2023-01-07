<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'employee_id',
        'vaccination_number',
        'vaccination_date',
        'next_vaccination_date',
        'is_vaccinated',
    ];

    protected $table = 'vaccination';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
