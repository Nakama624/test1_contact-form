<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password as FortifyPassword;
use App\Http\Requests\CertificationRequest;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    protected function passwordRules(): array
    {
      return ['required', 'string', new FortifyPassword];
    }
    public function create(array $input): User
    {
        // requestformのバリデーションを使用
        $request  = new CertificationRequest();
        $rules    = $request->rules();
        $messages = method_exists($request, 'messages') ? $request->messages() : [];

        Validator::make($input, $rules, $messages)->validate();

        // 通ったらユーザー作成
        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
