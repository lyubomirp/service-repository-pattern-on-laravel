<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface {

    public function allWithPagination(array $columns = ['*'], int $pagination = 50) : LengthAwarePaginator;

    public function create(array $payload) : ?Model;

    public function filter(array $conditions, int $pagination) : LengthAwarePaginator;

    public function findById(int $id) : ?Model;

}
