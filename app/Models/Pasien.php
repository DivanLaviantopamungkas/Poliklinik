<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = ['nama', 'alamat', 'telepon'];

    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'pasien_id', 'id');
    }
}
