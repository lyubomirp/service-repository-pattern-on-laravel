<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Services\AccountService;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    private $clientService;
    private $accountService;

    public function __construct(ClientService $clientService, AccountService $accountService) {
        $this->clientService = $clientService;
        $this->accountService = $accountService;
    }

    public function filterClients(Request $request) {
        $data = $request->only([
            "client_id_filter",
            "name_filter",
            "phone_filter",
            "iban_filter",
            "date_start_filter",
            "date_end_filter",
            "count"
        ]);

        $clients = $this->clientService->filter($data);

        if (isset($data["iban_filter"])) {
            if($clients->count() <= 0) {
                $clients = $this->accountService->getByParameter($data);
            }

            $collection = $clients->getCollection()->filter(function ($item) use ($data) {
                return strpos($item->iban, $data["iban_filter"]);
            })->values();
            $clients->setCollection($collection);
        }

        if (isset($data["date_start_filter"]) && isset($data["date_end_filter"])) {
            if($clients->count() <= 0) {
                $clients = $this->clientService->findByDates($data);
            }
            $collection = $clients->getCollection()->filter(function ($item) use ($data) {
                if ($item->created_at <= $data["date_end_filter"] || $item->created_at >= $data["date_start_filter"]) {
                    return $item;
                }
                return null;
            })->values();
            $clients->setCollection($collection);
        }

        $result = $this->formatClients($clients);

        return response()->json($result);
    }

    public function listClients(int $count): JsonResponse {
        $clients = $this->clientService->allWithPagination($count);
        $result = $this->formatClients($clients);
        return response()->json($result);
    }

    public function index(): \Illuminate\Contracts\View\View {
        return View::make("welcome");
    }

    private function formatClients(LengthAwarePaginator $paginator): array {
        $html = "";

        foreach($paginator->getCollection() as $item){

            if (isset($item->iban)) {
                $last = $this->accountService->compareLatestAccount($item->id, $item->account_id);
                $html .= \view("partials/table_rows", ["client" => $item, "iban" => $item->iban, "last" => $last]);
            }

            $accounts = $this->accountService->getByClientId($item->id);

            if ($accounts->isEmpty()) {
                $html .= \view("partials/table_rows", ["client" => $item]);
                continue;
            }

            $html .= \view("partials/table_rows", ["client" => $item, "iban" => $accounts->last()->iban, "last" => true]);
        }
        $links = $paginator->render("/vendor/pagination/bootstrap-4")->toHtml();

        return [
            'rows' => $html,
            'links' => $links
        ];
    }
}
