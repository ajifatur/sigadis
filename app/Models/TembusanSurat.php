<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TembusanSurat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_tembusan_surat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * Tembusan.
     */
    public function tembusan()
    {
        return $this->belongsTo(Tembusan::class, 'tembusan_id');
    }
}