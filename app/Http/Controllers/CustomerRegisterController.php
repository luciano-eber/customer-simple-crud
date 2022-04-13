<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\Register as RegisterRequest;

class CustomerRegisterController extends Controller
{
    public function handle(RegisterRequest $request)
    {
        dd($request);
    }
}
