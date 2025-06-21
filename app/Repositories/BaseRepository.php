<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class BaseRepository implements RepositoryInterface
{

    /** @var Model $model */
    protected $model;

    /**
     * Summary of BaseRepository __construct
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Summary of all
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Summary of find
     * @param mixed $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find($id, array $columns = ['*'], array $relations = []): Model
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    /**
     * Summary of create
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Summary of update
     * @param mixed $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Summary of delete
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Summary of search
     * @param Collection $filters
     * @return EloquentBuilder
     */
    public function search(SupportCollection $filters, array $relations = []): EloquentBuilder
    {
        $query = $this->model->with($relations);

        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query;
    }

    /**
     * Summary of getPaginated
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function getPaginated(array $filters = [], array $columns = ['*'], array $relations = []): LengthAwarePaginator
    {
        $filterData = collect($filters)->except(['page', 'per_page']);

        $query = $this->search($filterData, $relations);

        $perPage = $filters['per_page'] ?? 10;
        $page = $filters['page'] ?? 1;

        return $query->paginate($perPage, $columns, 'page', $page);
    }

}