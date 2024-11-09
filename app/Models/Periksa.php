<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksas';

    protected $fillable = ['pasien_id', 'dokter_id', 'tgl_periksa', 'catatan', 'obat'];

    // Relasi dengan Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id'); // Relasi ke Pasien
    }

    // Relasi dengan Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
    }
}
