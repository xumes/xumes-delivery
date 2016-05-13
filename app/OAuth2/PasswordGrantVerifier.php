<?php
/**
 * Created by PhpStorm.
 * User: Reginaldo
 * Date: 12/05/2016
 * Time: 13:15
 */

namespace CodeDelivery\OAuth2;


use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}