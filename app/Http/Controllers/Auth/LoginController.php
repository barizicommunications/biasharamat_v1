<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $data = $request->validated();

        if (auth()->attempt($data)) {
            return redirect()->route('activeIntro');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
}
