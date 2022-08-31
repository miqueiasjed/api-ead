<?php

namespace App\Http\Controllers;

use App\Helpers\OrderByHelper;
use App\Services\ServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Routing\Controller as BaseController;

abstract class AbstractController extends BaseController implements ControllerInterface
{
    protected ServiceInterface $service;

    protected array $searchFiels = [];

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(Request $request): JsonResponse
    {
        try{
            $data = $this->service->create($request->all());
            $response = $this->successResponse($data, Response::HTTP_CREATED);
        }catch (Exception $e){
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    public function all(Request $request): JsonResponse
    {
        try{
            $limit = (int) $request->get('limit', 10);
            $orderBy = $request->get('order_by', []);

            if(!empty($orderBy)){
                $orderBy = OrderByHelper::orderBy($orderBy);
            }

            $searchString = $request->get('q', '');

            if(!empty($searchString)){
                $data = $this->service->search($searchString, $this->searchFields, $limit, $orderBy);
            }else{
                $data = $this->service->all($limit, $orderBy);
            }

            $response = $this->successResponse($data, Response::HTTP_PARTIAL_CONTENT);
        }catch(Exception $e){
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

        return response()->json($response, $response['status_code']);
    }

    public function edit(Request $request, string $param): JsonResponse
    {
        try{
            $data['edited'] = $this->service->edit($param, $request->all());
            $response = $this->successResponse($data);
        }catch(Exception $e){
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        try{
            $data['deleted'] = $this->service->delete($id);
            $response = $this->successResponse($data);
        }catch(Exception $e){
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    protected function successResponse(array $data, int $statusCode = Response::HTTP_OK): array
    {
        return [
            'status_code' => $statusCode,
            'data' => $data
        ];
    }

    protected function errorResponse(Exception $e, int $statusCode = Response::HTTP_BAD_REQUEST): array
    {
        return [
            'status_code' => $statusCode,
            'error' => true,
            'error_description' => $e->getMessage()
        ];
    }


}
