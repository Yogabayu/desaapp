<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageGallery extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'village_id',
        'type_gallery_id',
        'name',
        'desc',
        'image',
        'boolean',
    ];

    public function village()
    {
        return $this->belongsTo(GeneralInfo::class, 'village_id', 'id');
    }

    public function type_gallery()
    {
        return $this->belongsTo(TypeGalery::class, 'type_gallery_id', 'id');
    }
}
