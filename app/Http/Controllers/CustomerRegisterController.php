<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\Register as RegisterRequest;
use App\Models\Customer;

class CustomerRegisterController extends Controller
{
    public function handle(RegisterRequest $request)
    {
        Customer::create($request->all());
        return redirect()->back();
    }
}
