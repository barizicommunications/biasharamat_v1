<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function createAccount(RegisterRequest $request)
    {
        $data = $request->validated();
        $firstName = explode(' ', $data['name'])[0] ?? '';
        $lastName = explode(' ', $data['name'])[1] ?? '';

        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['password'] = bcrypt($data['password']);

        unset($data['name']);
        $user = User::create($data);

        auth()->loginUsingId($user->id);

        return redirect()->route('sellerProfileOverview');
    }
}
