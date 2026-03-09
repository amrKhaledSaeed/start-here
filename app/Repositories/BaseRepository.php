<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class BaseRepository
{
    /**
     * @return class-string<TModel>
     */
    abstract protected function modelClass(): string;

    /**
     * @return Builder<TModel>
     */
    public function query(): Builder
    {
        $modelClass = $this->modelClass();

        return $modelClass::query();
    }

    /**
     * @param  array<array-key, string>  $columns
     * @return Collection<int, TModel>
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->query()->get($columns);
    }

    /**
     * @param  array<array-key, string>  $columns
     * @return TModel|null
     */
    public function find(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->query()->find($id, $columns);
    }

    /**
     * @param  array<array-key, string>  $columns
     * @return TModel
     */
    public function findOrFail(int|string $id, array $columns = ['*']): Model
    {
        return $this->query()->findOrFail($id, $columns);
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    public function create(array $attributes): Model
    {
        return $this->query()->create($attributes);
    }

    /**
     * @param  TModel|int|string  $model
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    public function update(Model|int|string $model, array $attributes): Model
    {
        $modelToUpdate = $model instanceof Model ? $model : $this->findOrFail($model);
        $modelToUpdate->fill($attributes);
        $modelToUpdate->save();

        return $modelToUpdate;
    }

    /**
     * @param  TModel|int|string  $model
     */
    public function delete(Model|int|string $model): bool
    {
        $modelToDelete = $model instanceof Model ? $model : $this->findOrFail($model);

        return (bool) $modelToDelete->delete();
    }
}
