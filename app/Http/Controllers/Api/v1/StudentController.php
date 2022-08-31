<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\AbstractController;
use App\Services\StudentService;

class StudentController extends AbstractController
{
    protected array $searchFields = [
        'name',
        'email'
    ];

    public function __construct(StudentService $service)
    {
        parent::__construct($service);
    }
}
