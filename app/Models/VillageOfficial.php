<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageOfficial extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'slug',
        'village_id',
        'name',
        'position',
        'image',
    ];

    // Jika Anda ingin menggunakan 'slug' sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi dengan Village
    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id', 'id');
    }
}
