<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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




        try {
            $validatedData = $request->validated();
            dd($validatedData);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
    }


}
