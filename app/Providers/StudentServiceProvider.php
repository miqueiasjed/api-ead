<?php

namespace App\Providers;

use App\Models\Student;
use App\Repositories\StudentRepository;
use App\Services\StudentService;
use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(StudentService::class, function($app){
            return new StudentService(new StudentRepository(new Student()));
        });
    }
}
