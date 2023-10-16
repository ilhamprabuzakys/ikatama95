<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarunaPhoto extends Model
{
    use HasFactory;
    protected $table = 'taruna_photos';
    protected $guarded = ['id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
