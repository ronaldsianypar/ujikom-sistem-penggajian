<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganGaji extends Model
{
    use HasFactory;

    protected $table = 'keterangan_gaji';

    protected $fillable = [
        'keterangan',
        'debitkredit',
    ];

    public $timestamps = false;
}