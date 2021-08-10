<?php


namespace App\Repositories\Eloquent;


use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BaseRepository implements EloquentRepositoryInterface {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function allWithPagination(array $columns = ['*'], int $pagination = 50): LengthAwarePaginator {
        return $this->model->query()->select($columns)->orderByDesc("created_at")->paginate($pagination);
    }

    public function findById(int $id) : ?Model {
        return $this->model->find($id);
    }

    public function create(array $payload): ?Model {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function filter(array $conditions, int $pagination = 50) : LengthAwarePaginator {
        return $this->model->query()->orWhere($conditions)->paginate($pagination);
    }

}
