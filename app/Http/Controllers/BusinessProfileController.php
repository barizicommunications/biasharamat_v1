<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessProfileRegistrationRequest;

class BusinessProfileController extends Controller
{
    public function create()
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }

        return view('seller.business-profile-registration');
    }

    public function store(BusinessProfileRegistrationRequest $request)
    {
        $data = $request->validated();

        dd($data);
    }
}
