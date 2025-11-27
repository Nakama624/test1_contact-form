<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    public function authorize()
    {
        return true;
    }
    // ログイン用のバリデーションルール
    // CertificationRequest のルールをベースに
    public function rules()
    {
        $certificationRequest = new CertificationRequest();

        $rules = $certificationRequest->rules();

        // ログインでは name は不要
        unset($rules['name']);

        return $rules;
    }

    public function messages()
    {
        $certificationRequest = new CertificationRequest();

        return $certificationRequest->messages();
    }
}
