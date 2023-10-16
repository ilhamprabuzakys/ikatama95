<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolaseAlbumPhoto extends Model
{
    use HasFactory;
    protected $table = 'kolase_album_photos';

    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

}
