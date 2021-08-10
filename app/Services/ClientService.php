<?php


namespace App\Services;


use App\Repositories\Eloquent\ClientRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;

class ClientService {

    protected $clientRepository;

    /**
     * ClientService constructor.
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;
    }

    public function filter(Array $params) {
        $validator = Validator::make($params, [
            'count' => 'required|in:25,50,100',
        ]);

        $conditions = [];

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!empty($params['client_id_filter'])) {
            array_push($conditions,
                ["id", "like", "%" . $params['client_id_filter'] . "%"]
            );
        }
        if (!empty($params['name_filter'])) {
            return $this->clientRepository->findClientsByNameOrId($params['name_filter'], $params['count']);
        }
        if (!empty($params['phone_filter'])) {
            array_push($conditions,
                ["phone", "like", "%" . $params['phone_filter'] . "%"],
            );
        }

        return $this->clientRepository->filter($conditions, $params["count"]);
    }

    public function allWithPagination(int $pagination) : LengthAwarePaginator {
        return $this->clientRepository->allWithPagination(['*'], $pagination);
    }

    public function findByDates(Array $params) {
        $dates = [
            "from" => Carbon::parse($params["date_start_filter"])->format("Y-m-d h:i:s"),
            "to" => Carbon::parse($params["date_end_filter"])->format("Y-m-d h:i:s"),
        ];

        $count = $params["count"];

        return $this->clientRepository->findDateRange($dates, $count);
    }

    public function findClientsByNameOrId(Array $params) {
        return $this->clientRepository->findClientsByNameOrId($params["client_param"])->getCollection();
    }

    public function saveClientData($data) {
        $validator = Validator::make($data, [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone' => [
                'required',
                'unique:clients',
                'regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/'
            ]
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->clientRepository->create($data);
    }
}
