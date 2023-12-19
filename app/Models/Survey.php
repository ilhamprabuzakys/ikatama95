<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $guarded = ['id'];


    public function scopeGlobalSearch($query, $search)
    {
        $search = strtolower($search);

        return $query->whereRaw(
            "LOWER(nama) LIKE '%{$search}%' OR 
                            LOWER(panggilan) LIKE '%{$search}%' OR
                            LOWER(tempat_lahir) LIKE '%{$search}%' OR 
                            LOWER(status_kedinasan) LIKE '%{$search}%' OR 
                            LOWER(status_pernikahan) LIKE '%{$search}%' OR 
                            LOWER(email) LIKE '%{$search}%' OR 
                            LOWER(nrp) LIKE '%{$search}%' OR 
                            LOWER(timestamp::text) LIKE '%{$search}%' OR 
                            LOWER(pangkat) LIKE '%{$search}%'"
        );
    }


    public function tarunaPhotos()
    {
        return $this->hasMany(TarunaPhoto::class);
    }

    public function baktiPhotos()
    {
        return $this->hasMany(BaktiPhoto::class);
    }

    public function berkaryaPhotos()
    {
        return $this->hasMany(BerkaryaPhoto::class);
    }
    
    public function kolasePhotos()
    {
        return $this->hasMany(KolaseAlbumPhoto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
