<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;

abstract class abstractService implements ServiceInterface
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): array
    {
        return $this->repository->create($data);
    }

    public function all(int $limit = 10, array $orderBy = []): array
    {
        return $this->repository->all($limit, $orderBy);
    }

    public function find(int $id): array
    {
        return $this->repository->find($id);
    }

    public function edit(string $param, array $data): bool
    {
        return $this->repository->edit($param, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function search(string $string, array $searchFields, int $limit = 10, array $orderBy = []): array
    {
        return $this->repository->search($string, $searchFields, $limit, $orderBy);
    }
}
