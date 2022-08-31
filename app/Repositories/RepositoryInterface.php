<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all(int $limit = 10, array $orderBy = []): array;
    
    public function create(array $data): array;

    public function find(int $id): array;

    public function edit(string $param, array $data): bool;

    public function delete(int $id): bool;

    public function search(string $string, array $searchFiles, int $limit = 10, array $orderBy = []): array;
}

