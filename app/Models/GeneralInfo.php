<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasUuids;

    protected $fillable = [
        'slug',
        'name',
        'address',
        'fb',
        'wa',
        'ig',
        'ytb',
        'email',
        'web',
        'tlp',
        'short_desc',
        'long_desc',
        'logo',
        'general_image',
        'area',
        'total_population',
        'total_dusun',
        'total_rt',
        'total_umkm',
        'fasilities',
        'general_work',
        'visi',
        'misi',
    ];

    // Jika Anda ingin menggunakan 'slug' sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function umkms()
    {
        return $this->hasMany(Umkm::class, 'village_id');
    }

}