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

    // Relasi dengan VillageOfficial
    // public function villageOfficials()
    // {
    //     return $this->hasMany(VillageOfficial::class, 'village_id');
    // }

    // // Relasi dengan VillageGallery
    // public function villageGalleries()
    // {
    //     return $this->hasMany(VillageGallery::class, 'village_id');
    // }

    // // Relasi dengan Article
    // public function articles()
    // {
    //     return $this->hasMany(Article::class, 'village_id');
    // }

    // // Relasi dengan Umkm
    // public function umkms()
    // {
    //     return $this->hasMany(Umkm::class, 'village_id');
    // }

    // // Relasi dengan Apbd
    // public function apbds()
    // {
    //     return $this->hasMany(Apbd::class, 'village_id');
    // }

    // Accessor untuk mendapatkan URL logo
    // public function getLogoUrlAttribute()
    // {
    //     return $this->logo ? asset('storage/' . $this->logo) : null;
    // }

    // // Accessor untuk mendapatkan URL gambar umum
    // public function getGeneralImageUrlAttribute()
    // {
    //     return $this->general_image ? asset('storage/' . $this->general_image) : null;
    // }
}