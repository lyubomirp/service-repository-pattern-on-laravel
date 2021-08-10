<?php


namespace App\Repositories\Eloquent;


use App\Models\Accounts;
use App\Repositories\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface {
    protected $model;

    /**
     * AccountRepository constructor.
     * @param Accounts $model
     */
    public function __construct(Accounts $model) {
        parent::__construct($model);
    }

    public function getAccountsByClientId(int $clientId) : Collection {
        return $this->model->query()->where("client_id", $clientId)->get();
    }

    public function filterAndJoin(array $conditions, int $pagination) : LengthAwarePaginator {
        return $this->model->query()
            ->select(["accounts.id as account_id",
                "accounts.iban",
                "clients.id",
                "clients.first_name",
                "clients.middle_name",
                "clients.last_name",
                "clients.phone",
                "clients.created_at"])
            ->where($conditions)
            ->join('clients', 'accounts.client_id', '=', 'clients.id')
            ->paginate($pagination);
    }

}
