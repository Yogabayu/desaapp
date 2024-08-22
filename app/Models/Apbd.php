<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbd extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'village_id',
        'description',
        'amount',
        'date',
        'type',
    ];

    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id', 'id');
    }
}
