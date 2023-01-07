<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccinator_id',
        'vaccine_type_id',
        'organizer',
        'registration_date_start',
        'registration_date_end',
        'implementation_date',
        'implementation_time_start',
        'implementation_time_end',
        'location',
        'quota',
    ];

    protected $table = 'schedule';

    public function vaccinator()
    {
        return $this->belongsTo(Vaccinator::class);
    }

    public function vaccineType()
    {
        return $this->belongsTo(VaccineType::class);
    }

    public function participants()
    {
        return $this->hasMany(Vaccination::class);
    }
}
