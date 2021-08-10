<?php


namespace App\Services;


use App\Models\Accounts;
use App\Repositories\Eloquent\AccountRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class AccountService
{
    protected $accountRepository;

    /**
     * ClientService constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository) {
        $this->accountRepository = $accountRepository;
    }

    public function getByClientId(int $clientId) : Collection {
        return $this->accountRepository->getAccountsByClientId($clientId);
    }

    public function compareLatestAccount(int $client_id, int $account_id) : bool {
        $latest = $this->accountRepository
            ->getAccountsByClientId($client_id)
            ->sortByDesc("created_at")
            ->first();

        if ($account_id === $latest->id) {
            return true;
        }

        return false;
    }

    public function getByParameter(array $params) {
        $validator = Validator::make($params, [
            'count' => 'required|in:25,50,100',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $value = $params["iban_filter"];

        $conditions = [
            ["iban", "like", "%$value%"]
        ];

        return $this->accountRepository->filterAndJoin($conditions, $params['count']);
    }

    public function saveAccountData($data) {
        $validator = Validator::make($data, [
            'iban' => 'required|max:34|min:5|unique:accounts',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->accountRepository->create($data);
    }

}
