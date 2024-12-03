<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UsersFormRequest;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->orderBy('id')->paginate(10),
        ]);
    }

    public function edit(User $user): View
    {
        $permissions = Permission::where('name', 'like', '%' . 'shop' . '%')->get();

        $userPermissions = Permission::where('model_id', $user->id);

        return view('admin.users.edit', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    public function update(User $user, UsersFormRequest $request): RedirectResponse
    {
        $user->fill($request->all());

        $user->save();

        return to_route('admin.users.edit', $user)
            ->with('status', "Usuário '{$user->name}' atualizado!");
    }

    public function destroy(User $user, Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', "Usuário '{$user->name}' excluído!");
    }
}
