<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

class StudentRepository extends AbstractRepository
{
    public function all(int $limit = 10, array $orderBy = []): array
    {
        $data = $this->model::query()->with('course');

        foreach ($orderBy as $key => $value) {
            if (strstr($key, '-')) {
                $key = substr($key, 1);
            }

            $data->orderBy($key, $value);
        }

        return $data->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'limit' => $limit
            ])
            ->toArray();
    }

    public function find(int $id): array
    {
        return $this->model::findOrFail($id)->with('course')->first()->toArray();
    }
}
