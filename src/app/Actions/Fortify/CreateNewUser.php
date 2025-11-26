<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password as FortifyPassword;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    // 確認用パスワードは外す
    protected function passwordRules(): array
    {
      return ['required', 'string', new FortifyPassword];
    }
    public function create(array $input): User
    {
      Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'password' => $this->passwordRules(),
      ])->validate();

      return User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
      ]);
    }
}
