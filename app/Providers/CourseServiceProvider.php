<?php

namespace App\Providers;

use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Services\CourseService;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CourseService::class, function($app){
            return new CourseService(new CourseRepository(new Course()));
        });
    }
}
