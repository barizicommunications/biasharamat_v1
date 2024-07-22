<?php

namespace App\Http\Controllers\Auth;


use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{

    public function attachRole(Role $role)
    {
        roles()->attach($role);
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'registration_type' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'registration_type' => $request->registration_type,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        $roleName = $request->registration_type;

        $role = Role::where('name', $roleName)->first(); // Find the first role matching the name

        if (!$role) {
            // Create the role if it doesn't exist
            $role = Role::create(['name' => $roleName]);
        }

        $user->assignRole($role);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
