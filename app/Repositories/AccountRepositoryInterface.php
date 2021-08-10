<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AccountRepositoryInterface extends EloquentRepositoryInterface {

    public function getAccountsByClientId(int $clientId) : Collection;

    public function filterAndJoin(array $conditions, int $pagination) : LengthAwarePaginator;

}
