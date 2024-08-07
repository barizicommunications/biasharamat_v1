<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SellerRegistrationRequest;

class SellerRegistrationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerRegistrationRequest $request)
    {
        $firstName = explode(' ', $request->seller_name)[0];
        $lastName = explode(' ', $request->seller_name)[1];

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'registration_type'=> "Business Seller",
            'password' => bcrypt($request->seller_password),
            'email' => $request->seller_email,
        ];

        $user = User::create($data);

        $roleName = "Business Seller";

        $role = Role::where('name', $roleName)->first(); // Find the first role matching the name

        if (!$role) {
            // Create the role if it doesn't exist
            $role = Role::create(['name' => $roleName]);
        }

        $user->assignRole($role);



        Auth::loginUsingId($user->id);

        return redirect()->route('business.profile.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.register-business-seller');
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
