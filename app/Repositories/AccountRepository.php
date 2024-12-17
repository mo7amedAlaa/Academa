<?php

namespace App\Repositories;

use App\Dto\AccountDto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountRepository
{
    public function updateAccount(AccountDto $accountDto)
    {
        $user = Auth::user();


        if (!Hash::check($accountDto->current_password, $user->password)) {
            return ['error' => 'The provided current password is incorrect.'];
        }


        $user->email = $accountDto->email;


        if (!empty($accountDto->password)) {
            $user->password = Hash::make($accountDto->password);
        }


        if ($user->save()) {
            return ['success' => true];
        }

        return ['error' => 'Failed to update account. Please try again.'];
    }
    public function deleteAccount()
    {
        $user = Auth::user();
        if (
            $user->delete()
        ) {

            Auth::logout();
            return true;
        }
        return false;
    }
}
