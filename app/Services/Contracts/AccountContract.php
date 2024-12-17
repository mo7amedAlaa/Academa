<?php

namespace App\Services\Contracts;

use App\Dto\AccountDto;

interface  AccountContract
{
    public function updateAccount(AccountDto $accountDto);
    public function deleteAccount();
}
