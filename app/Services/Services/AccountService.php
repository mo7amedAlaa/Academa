<?php

namespace App\Services\Services;

use App\Dto\AccountDto;
use App\Repositories\AccountRepository;
use App\Services\Contracts\AccountContract;


class AccountService implements AccountContract
{
    protected AccountRepository $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }
    public function updateAccount(AccountDto $accountDto)
    {
        return $this->accountRepository->updateAccount($accountDto);
    }
    public function deleteAccount()
    {
        return $this->accountRepository->deleteAccount();
    }
}
