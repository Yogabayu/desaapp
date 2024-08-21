<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'village_id',
        'slug',
        'name',
        'desc',
        'tlp',
        'fb',
        'ig',
    ];

    //route
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id', 'id');
    }
}
