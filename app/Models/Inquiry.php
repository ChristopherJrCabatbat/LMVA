<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'contact_number',
        'patient_name',
        'date',
        'inquiry',
        'response',
        'response_file',
        'original_file_name',
        'payment_method',
    ];
}
