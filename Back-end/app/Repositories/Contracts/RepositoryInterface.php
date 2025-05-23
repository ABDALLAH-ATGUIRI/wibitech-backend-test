<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

interface RepositoryInterface
{
    /**
     * Summary of all
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Summary of find
     * @param mixed $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find($id, array $columns = ['*'], array $relations = []): Model;

    /**
     * Summary of create
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Summary of update
     * @param mixed $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool;

    /**
     * Summary of delete
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * Summary of search
     * @param Collection $filters
     * @param array $relations
     * @return Builder
     */
    public function search(SupportCollection $filters, array $relations = []): Builder;

    /**
     * Summary of getPaginated
     * @param array $filters
     * @param array $columns
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function getPaginated(array $filters = [], array $columns = ['*'], array $relations = []): LengthAwarePaginator;
}
