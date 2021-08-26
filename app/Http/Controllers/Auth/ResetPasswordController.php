<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function validationErrorMessages()
    {
        return [

            'required' => 'O campo precisa ser preenchido',

            'email.email' => 'O campo E-mail não é válido.',

            'password.confirmed' => 'As senhas devem ser iguais',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
        ];
    }
}
