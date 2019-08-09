<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request)
    {
        $request->user()->update($request->all());
    }
}
