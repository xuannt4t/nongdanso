<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function __construct(protected Model $model) {}

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->query()->get($columns);
    }

    public function with(array|string $relations): Builder
    {
        return $this->query()->with($relations);
    }

    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage, $columns);
    }

    public function find(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->query()->find($id, $columns);
    }

    public function findOrFail(int|string $id, array $columns = ['*']): Model
    {
        return $this->query()->findOrFail($id, $columns);
    }

    public function firstWhere(array $conditions, array $columns = ['*']): ?Model
    {
        return $this->query()->where($conditions)->first($columns);
    }

    public function getWhere(array $conditions, array $columns = ['*']): Collection
    {
        return $this->query()->where($conditions)->get($columns);
    }

    public function paginateWhere(array $conditions, int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->query()->where($conditions)->paginate($perPage, $columns);
    }

    public function exists(array $conditions): bool
    {
        return $this->query()->where($conditions)->exists();
    }

    public function count(array $conditions = []): int
    {
        return $this->query()->where($conditions)->count();
    }

    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    public function update(int|string $id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);

        return $record->refresh();
    }

    public function updateWhere(array $conditions, array $data): int
    {
        return $this->query()->where($conditions)->update($data);
    }

    public function delete(int|string $id): bool
    {
        return (bool) $this->findOrFail($id)->delete();
    }

    public function deleteWhere(array $conditions): int
    {
        return $this->query()->where($conditions)->delete();
    }

    public function firstOrCreate(array $attributes, array $values = []): Model
    {
        return $this->query()->firstOrCreate($attributes, $values);
    }

    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->query()->updateOrCreate($attributes, $values);
    }
}
