<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        // dd(1);
    }
	public function index()
	{
        $users=User::all();
        return Inertia::render('User/Users', [
            'users' => $users
        ]);
    }

    public function show($id)
	{
        $user = User::find($id);
		return Inertia::render('User/User', [
            'user' => $user,
            'userRoles' => $user->getAllRoles()->pluck('id'),
            'userPermissions' => $user->getAllPermissions()->pluck('id'),
            'allRoles' => Role::query()->select(['name','id'])->get(),
            'allPermissions' => Permission::query()->select(['name','id'])->get(),
        ]);
	}


    public function update(UpdateUserRequest $request, User $user)
	{        
        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'patronymic' => $request->get('patronymic'),
            'number'=> $request->get('number'),
            'email' => $request->get('email'),
        ]);
        return Redirect::route('users.index')->with('success', 'Пользователь был изменен');
	}

    public function destroy(User $user)
	{
        $user->delete();
        return Redirect::route('users.index')->with('success', 'Пользователь был удален');
	}
}