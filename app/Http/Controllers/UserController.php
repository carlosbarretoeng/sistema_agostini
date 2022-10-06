<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function index(Request $request) {
        $data = [
            'users' => User::orderBy('name')->get()
        ];
        return Inertia::render('User/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, User $user) {
        return $this->createOrShowOrEdit($request, $user, 'show');
    }

    /*function edit(Request $request, User $user) {
        return $this->createOrShowOrEdit($request, $user, 'edit');
    }*/

    function createOrShowOrEdit(Request $request, User | null $user, String $context) {
        $thisUser = $user ?? null;

        if($thisUser) $thisUser->getAllPermissions();

        $data = [
            'context' => $context,
            'thisUser' => $thisUser?->toArray(),
            'companies' => Company::all()->toArray(),
            'roles' => Role::all()->toArray()
        ];
        return Inertia::render('User/Info', $data);
    }

    function store(Request $request) {
        $attrs = $request->all();

        $newUser = new User();

        $newUser->name = $attrs['name'];
        $newUser->username = $attrs['username'];
        $newUser->email = $attrs['email'];
        $newUser->password = Hash::make($attrs['password']);

        if($attrs['company_id'] &&  $attrs['company_id'] != 'null') $newUser->company_id = $attrs['company_id'];

        $newUser->save();

        $role = Role::find($attrs['role_id'])->name;

        $newUser->assignRole($role);

        return Redirect::route('user.index');
    }

    function update(Request $request, User $user) {
        $attrs = $request->all();

        $user->name = $attrs['name'];
        $user->username = $attrs['username'];
        $user->email = $attrs['email'];

        if($attrs['company_id']) $user->company_id = $attrs['company_id'];

        $user->save();

        $roles = $user->getRoleNames();
        foreach ($roles as $role) $user->removeRole($role);

        $role = Role::find($attrs['role_id'])->name;

        $user->assignRole($role);
        $user->getAllPermissions();

        if($role != 'super-admin') return Redirect::route('dashboard.index');

        return Redirect::route('user.index');
    }

    function passwordUpdate(Request $request, User $user) {
        $attrs = $request->all();

        if($attrs['password'] === $attrs['retype']){
            $user->password = Hash::make($attrs['password']);
            $user->save();
        }

        return Redirect::route('user.index');
    }

    function destroy(Request $request, User $user){
        $user->delete();
        return Redirect::route('user.index');
    }
}
