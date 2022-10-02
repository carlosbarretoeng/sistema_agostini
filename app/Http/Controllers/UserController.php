<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\User;
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
        $data = [
            'context' => $context,
            'thisUser' => $user?->toArray() ?? null,
            'companies' => Company::all()->toArray(),
            'roles' => Role::all()->toArray()
        ];
        return Inertia::render('User/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('company.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $company = new Company();

            $company->name = $attrs['name'];

            $company->save();

            return Redirect::route('company.index');
        }
    }

    function update(Request $request) {
        $rules = [
            'id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('company.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $company = Company::find($attrs['id']);

            $company->name = $attrs['name'];

            $company->save();

            return Redirect::route('company.index');
        }
    }

    function destroy(Request $request, Company $company){
        foreach ($company->departments as $department) {
            (new DepartmentController())->destroy(null, $department);
        }

        foreach ($company->products as $product) {
            (new ProductController())->destroy(null, $product);
        }

        $company->delete();
        return Redirect::route('company.index');
    }
}
