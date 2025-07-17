<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function lections()
    {
        return $this->hasManyThrough(Lection::class, Section::class);
    }
}
