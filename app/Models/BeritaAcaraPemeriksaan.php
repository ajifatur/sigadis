<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraPemeriksaan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_berita_acara_pemeriksaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * Tim pemeriksa.
     */
    public function tim_pemeriksa()
    {
        return $this->hasMany(TimPemeriksa::class, 'bap_id');
    }
}