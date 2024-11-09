<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = ['nama', 'alamat', 'no_hp'];

    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'dokter_id', 'id');
    }
}
