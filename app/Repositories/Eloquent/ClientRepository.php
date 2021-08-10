<?php


namespace App\Repositories\Eloquent;


use App\Models\Clients;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface {

    protected $model;

    /**
     * ClientRepository constructor.
     * @param Clients $model
     */
    public function __construct(Clients $model) {
        parent::__construct($model);
    }

    public function findDateRange(Array $dates, int $count) : LengthAwarePaginator {
        return $this->model->query()->whereBetween('created_at',array($dates["from"],$dates["to"]))->paginate($count);
    }

    public function findClientsByNameOrId(string $parameter, int $count = 50) : LengthAwarePaginator {
       return $this->model->query()
           ->where("id", "=", "$parameter")
           ->orWhere("first_name", "like", "%$parameter%")
           ->orWhere("middle_name", "like", "%$parameter%")
           ->orWhere("last_name", "like", "%$parameter%")
           ->paginate($count);
    }
}


