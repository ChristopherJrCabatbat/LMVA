<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_details',
        'file',
        'category',
        'original_file_name',
    ];
}