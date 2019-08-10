<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Requests\UserAddRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $users = User::orderBy('id', 'DESC');
        $users = $users->whereNotIn('id', [$request->user()->id]);
        if(!$request->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')))
        {
            $users = $users->whereHas('roles', function($query) {
                $query->where('name', '!=', env('SUPER_ADMIN_ROLE_NAME'));
            });
        }
        if($request->q)
        {
            $users = $users->where('first_name', 'like', '%'.$request->q.'%')->orWhere('last_name', 'like', '%'.$request->q.'%')->orWhere('email', $request->q);
        }
        return $users->paginate(env('PAGINATION_RESULTS_LIMIT'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        if($request->user()->can('manage-roles') && $request->user()->id != $user->id)
        {
            $user->syncRoles([$request->roleid]);
        }
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
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

    public function store(UserAddRequest $request)
    {
        $user = new User($request->only(['first_name', 'last_name', 'email']));
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function check_token(Request $request)
    {
        $token = DB::table('password_resets')->where('email', $request->email)->where('created_at', '>=', Carbon::now()->subHours(1))->first();
        if($token && Hash::check($request->token, $token->token))
        {
            return response()->json(['valid' => true]);
        }
        return response()->json(['valid' => false]);
    }

    public function signupallowed()
    {
        return response()->json(['signupallowed' => strtolower(setting('allow_signups')) == 'yes']);
    }
}
