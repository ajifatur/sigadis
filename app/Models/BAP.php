<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BAP extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_bap';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * Kasus.
     */
    public function kasus()
    {
        return $this->belongsTo(Kasus::class, 'kasus_id');
    }
    
    /**
     * Pelanggaran.
     */
    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }

    /**
     * Tim pemeriksa.
     */
    public function tim_pemeriksa()
    {
        return $this->hasMany(TimPemeriksa::class, 'bap_id');
    }
}