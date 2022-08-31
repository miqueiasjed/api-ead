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

    public array $rules = [
        'course_id' => 'required',
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255',
        'birth_date' => 'required',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
