<?php

namespace App\Http\Controllers;

use App\Dto\AccountDto;
use App\Http\Requests\AccountRequest;
use App\Services\Facades\AccountFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('student.settings', compact('user'));
    }

    public function update(AccountRequest $request)
    {

        $accountDto = AccountDto::formArray($request);

        $updateResult = AccountFacade::updateAccount($accountDto);

        if (isset($updateResult['error'])) {
            return redirect()->route('settings')->withErrors(['current_password' => $updateResult['error']]);
        }

        return redirect()->route('settings')->with('success', 'Account updated successfully.');
    }

    public function delete()
    {
        if (AccountFacade::deleteAccount()) {

            return redirect()->route('login')->with('success', 'Account deleted successfully. You have been logged out.');
        } else {
            return redirect()->route('settings')->with('error', 'Failed to delete account. Please try again.');
        }
    }
}
