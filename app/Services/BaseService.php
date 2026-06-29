<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseService
{
    public function __construct(protected BaseRepository $repository) {}

    public function query(): Builder
    {
        return $this->repository->query();
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->repository->all($columns);
    }

    public function with(array|string $relations): Builder
    {
        return $this->repository->with($relations);
    }

    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $columns);
    }

    public function find(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->repository->find($id, $columns);
    }

    public function findOrFail(int|string $id, array $columns = ['*']): Model
    {
        return $this->repository->findOrFail($id, $columns);
    }

    public function firstWhere(array $conditions, array $columns = ['*']): ?Model
    {
        return $this->repository->firstWhere($conditions, $columns);
    }

    public function getWhere(array $conditions, array $columns = ['*']): Collection
    {
        return $this->repository->getWhere($conditions, $columns);
    }

    public function paginateWhere(array $conditions, int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->repository->paginateWhere($conditions, $perPage, $columns);
    }

    public function exists(array $conditions): bool
    {
        return $this->repository->exists($conditions);
    }

    public function count(array $conditions = []): int
    {
        return $this->repository->count($conditions);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(int|string $id, array $data): Model
    {
        return $this->repository->update($id, $data);
    }

    public function updateWhere(array $conditions, array $data): int
    {
        return $this->repository->updateWhere($conditions, $data);
    }

    public function delete(int|string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function deleteWhere(array $conditions): int
    {
        return $this->repository->deleteWhere($conditions);
    }

    public function firstOrCreate(array $attributes, array $values = []): Model
    {
        return $this->repository->firstOrCreate($attributes, $values);
    }

    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->repository->updateOrCreate($attributes, $values);
    }

    public function transaction(Closure $callback, int $attempts = 1): mixed
    {
        return DB::transaction($callback, $attempts);
    }
}
