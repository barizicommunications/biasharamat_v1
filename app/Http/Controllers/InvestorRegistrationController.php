<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvestorRegistrationRequest;

class InvestorRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.register-business-investor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvestorRegistrationRequest $request)
    {
        $nameParts = explode(' ', $request->buyer_name);
        $firstName = $nameParts[0]; // First part is always there
        $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : 'buyer'; // Default to "buyer" if no last name

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'registration_type' => "Business Buyer",
            'password' => bcrypt($request->buyer_password),
            'email' => $request->buyer_email,
        ];

        $user = User::create($data);
        $roleName = "Business Buyer";
        $role = Role::where('name', $roleName)->first(); // Find the first role matching the name

        if (!$role) {
            // Create the role if it doesn't exist
            $role = Role::create(['name' => $roleName]);
        }

        $user->assignRole($role);
        Auth::loginUsingId($user->id);

        return redirect()->route('investor.profile.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}