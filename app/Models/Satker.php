<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'satker_bnn';

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function relawans()
    {
        return $this->hasMany(Relawan::class);
    }
}
