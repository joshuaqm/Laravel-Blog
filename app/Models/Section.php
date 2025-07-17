<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lections()
    {
        return $this->hasMany(Lection::class);
    }
}
