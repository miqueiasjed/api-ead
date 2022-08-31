<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
