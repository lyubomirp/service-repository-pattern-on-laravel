<?php


namespace App\Repositories;


use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface extends EloquentRepositoryInterface {

    public function findClientsByNameOrId(string $parameter, int $count) : LengthAwarePaginator;

    public function findDateRange(Array $dates, int $count) : LengthAwarePaginator;

}
