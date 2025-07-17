<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lection extends Model
{
    /** @use HasFactory<\Database\Factories\LectionFactory> */
    use HasFactory;

    protected $fillable = [
        'name', // Name of the lection
    ];
}
