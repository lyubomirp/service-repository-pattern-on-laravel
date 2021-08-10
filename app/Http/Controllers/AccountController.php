<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCreateRequest;
use App\Services\AccountService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class AccountController extends Controller
{
    private $accountService;

    public function __construct(AccountService $accountService) {
        $this->accountService = $accountService;
    }

    public function createAccount(AccountCreateRequest $request) {
        $data = $request->only([
            "iban",
            "client_id",
        ]);

        $result = $this->accountService->saveAccountData($data);

        if ($result instanceof MessageBag) {
            Session::flash('error', 'Account creation failed!');
            return View::make('partials/flash_message');
        }

        Session::flash('success', 'Account created successfully!');
        return View::make('partials/flash_message');
    }
}
