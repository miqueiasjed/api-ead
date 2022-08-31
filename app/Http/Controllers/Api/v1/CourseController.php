<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\AbstractController;
use App\Services\CourseService;

class CourseController extends AbstractController
{
    protected array $searchFields = [
        'title',
    ];

    public function __construct(CourseService $service)
    {
        parent::__construct($service);
    }
}
