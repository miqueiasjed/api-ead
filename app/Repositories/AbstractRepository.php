<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data): array
    {
        return $this->model::create($data)->toArray();
    }

    public function all(int $limit = 10, array $orderBy = []): array
    {
        $data = $this->model::query();

        foreach($orderBy as $key => $value){
            if(strstr($key, '-')) {
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
        return $this->model::findOrFail($id)->toArray();
    }

    public function edit(string $param, array $data): bool
    {
        $data = $this->model::find($param)->update($data);

        return $data ? true : false;
    }

    public function delete(int $id): bool
    {
        return $this->model::destroy($id) ? true : false;
    }

    public function search(string $string, array $searchFields, int $limit = 10, array $orderBy = []): array
    {
        $data = $this->model::where($searchFields[0], 'like', '%' . $string . '%');

        if(count($searchFields) > 1){
            foreach($searchFields as $field){
                $data->orWhere($field, 'like', '%' . $field . '%');
            }
        }

        foreach($orderBy as $key => $value){
            if(strstr($key, '-')){
                $key = substr($key, 1);
            }

            $data->orderBy($key, $value);
        }

        return $data->paginate($limit)
        ->appends([
            'order_by' => implode(',', array_keys($orderBy)),
            'q' => $string,
            'limit' => $limit
        ])
        ->toArray();
    }
}

