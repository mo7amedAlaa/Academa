<?php

namespace App\Dto;

use App\Http\Requests\AccountRequest;

class AccountDto
{
    public string $email;
    public string $current_password;
    public ?string $password;

    public function __construct(string $email, string $current_password, ?string $password = null)
    {
        $this->email = $email;
        $this->current_password = $current_password;
        $this->password = $password;
    }
    public static function formArray(AccountRequest $request): self
    {
        return new self(
            email: $request->email,
            current_password: $request->current_password,
            password: $request->password,
        );
    }
}
