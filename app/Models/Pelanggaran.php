<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_pelanggaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * Kewajiban / larangan.
     */
    public function kl()
    {
        return $this->belongsTo(KL::class, 'kl_id');
    }
    
    /**
     * Jenis.
     */
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}