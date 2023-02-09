<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_kasus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * Surat panggilan.
     */
    public function surat_panggilan()
    {
        return $this->hasMany(SuratPanggilan::class);
    }
    
    /**
     * BAP.
     */
    public function bap()
    {
        return $this->hasMany(BAP::class);
    }
    
    /**
     * LHP.
     */
    public function lhp()
    {
        return $this->hasMany(LHP::class);
    }
    
    /**
     * KPTS.
     */
    public function kpts()
    {
        return $this->hasMany(KPTS::class);
    }
    
    /**
     * Kephukdis.
     */
    public function kephukdis()
    {
        return $this->hasMany(Kephukdis::class);
    }
    
    /**
     * SPMK.
     */
    public function spmk()
    {
        return $this->hasMany(SPMK::class);
    }
}