<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface ControllerInterface
{
    public function create(Request $request): JsonResponse;

    public function all(Request $request): JsonResponse;

    public function find(Request $request, int $id): JsonResponse;

    public function edit(Request $request, string $param): JsonResponse;

    public function delete(Request $request, int $id): JsonResponse;
}
