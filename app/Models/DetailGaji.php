<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGaji extends Model
{
    use HasFactory;

    protected $table = 'detail_gaji';

    protected $fillable = [
        'no_ref',
        'no',
        'nominal',
    ];

    public $timestamps = false;

    public function slipGaji()
    {
        return $this->belongsTo(SlipGaji::class, 'no_ref', 'no_ref');
    }

    public function keteranganGaji()
    {
        return $this->belongsTo(KeteranganGaji::class, 'no', 'no');
    }
}