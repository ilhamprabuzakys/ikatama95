<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkaryaPhoto extends Model
{
    use HasFactory;
    protected $table = 'berkarya_photos';
    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
