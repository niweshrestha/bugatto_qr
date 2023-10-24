<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'security_no',
        'qrs',
        'qr_path',
        'scanned',
    ];

    public function informations()
    {
        return $this->hasMany(Information::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
