<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'email',
        'birth_date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class)
    }
}
