<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_jenis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * Pelanggaran.
     */
    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
    
    /**
     * Hukdis.
     */
    public function hukdis()
    {
        return $this->hasMany(Hukdis::class);
    }
}