<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function attachRole(Role $role)
    {
      roles()->attach($role);
    }
    public function createAccount(RegisterRequest $request)
    {
        $data = $request->validated();
        $firstName = explode(' ', $data['name'])[0] ?? '';
        $lastName = explode(' ', $data['name'])[1] ?? '';

        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['registration_type'] = $request->registration_type;
        $data['password'] = bcrypt($data['password']);

        unset($data['name']);
        $user = User::create($data);

        $roleName = $request->registration_type;

        $role = Role::where('name', $roleName)->first(); // Find the first role matching the name

        if (!$role) {
            // Create the role if it doesn't exist
            $role = Role::create(['name' => $roleName]);
        }

        $user->assignRole($role);

        auth()->loginUsingId($user->id);



        // return redirect()->route('sellerProfileOverview');
        return redirect()->route('activeIntro');


    }
}
