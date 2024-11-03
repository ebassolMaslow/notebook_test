<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sketchpad extends Model
{
    use HasFactory;

    // protected $table = 'sketchpads';

    protected $fillable = [
        'FIO',
        'company',
        'telephone',
        'email',
        'date_of_birth',
        'photo',
    ];
}
