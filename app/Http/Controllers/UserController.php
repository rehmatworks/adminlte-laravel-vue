<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Spatie\Permission\Models\Role;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $users = new User;
        $users = $users->whereNotIn('id', [$request->user()->id]);
        if(!$request->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')))
        {
            $users = $users->whereHas('roles', function($query) {
                $query->where('name', '!=', env('SUPER_ADMIN_ROLE_NAME'));
            });
        }
        if($request->q)
        {
            $users = $users->where('name', 'like', '%s'.$request->q.'%s')->orWhere('email', $request->q);
        }
        return $users->paginate(10);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        if($request->user()->can('manage-roles') && $request->user()->id != $user->id)
        {
            $user->syncRoles([$request->roleid]);
        }
    }

    public function show(Request $request, User $user)
    {
        return $user;
    }

    public function get(Request $request)
    {
        return $request->user();
    }

    public function get_roles(Request $request)
    {
        return Role::all();
    }
}
