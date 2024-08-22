<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmReview extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['umkm_id', 'name', 'email', 'review'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
