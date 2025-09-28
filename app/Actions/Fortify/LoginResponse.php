<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();
        if ($user && in_array($user->role, ['admin', 'author'])) {
            return redirect()->intended('/dashboard');
        }
        return redirect()->intended('/');
    }
}