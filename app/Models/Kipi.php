<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kipi extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccination_id',
        'incident_date',
        'indication',
        'action',
        'is_contact_doctor',
    ];

    protected $table = 'kipi';

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class);
    }
}
