<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * @return Model
     */
    public function update($id, array $data): Model;

    /**
     * Summary of delete
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * Summary of search
     * @param array $data
     * @return Collection
     */
    public function search(array $data): Collection;
}
