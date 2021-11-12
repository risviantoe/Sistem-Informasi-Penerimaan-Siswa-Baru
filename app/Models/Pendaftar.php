<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'pendaftar';
    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'asal_sekolah',
        'jurusan_pilihan',
        'nilai_bind',
        'nilai_mtk',
        'nilai_ipa',
        'nilai_bing',
        'rata_rata',
        'status',
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y - H:i');
    }

}
