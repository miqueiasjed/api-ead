<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\OrderByHelper;
use Illuminate\Http\Response;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AbstractController;
use App\Services\CourseService;

class StudentController extends AbstractController
{
    protected array $searchFields = [
        'name',
        'email'
    ];

    protected $serviceCourse;

    public function __construct(StudentService $service, CourseService $serviceCourse)
    {
        parent::__construct($service);
        $this->serviceCourse = $serviceCourse;
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required',
        ]);

        try{
            $data = $this->service->create($request->all());
            $response = $this->successResponse($data, Response::HTTP_CREATED);
        }catch (Exception $e){
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }


    public function find(Request $request, int $id): JsonResponse
    {
        try{
            $data = $this->service->find($id);
            $response = $this->successResponse($data);
        }catch(Exception $e)
        {
            $response = $this->errorResponse($e);
        }

        $response['courses'] = $this->serviceCourse->all();

        return response()->json($response, $response['status_code']);
    }

    public function edit(Request $request, string $param): JsonResponse
    {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required',
        ]);

        try{
            $data['edited'] = $this->service->edit($param, $request->all());
            $response = $this->successResponse($data);
        }catch(Exception $e){
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
