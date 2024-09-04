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
        'is_active',
    ];

    //route
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id');
    }

    public function images()
    {
        return $this->hasMany(UmkmImage::class, 'umkm_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(UmkmReview::class, 'umkm_id', 'id');
    }
}
