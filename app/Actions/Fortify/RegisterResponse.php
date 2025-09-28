<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
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
