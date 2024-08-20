<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derm extends Model
{
    use HasFactory;

    protected $fillable = [
        'derm',
        'qr_code',
    ];
}
