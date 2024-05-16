<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRegistrationRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

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
            'password' => bcrypt($request->seller_password),
            'email' => $request->seller_email,
        ];

        $user = User::create($data);

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
