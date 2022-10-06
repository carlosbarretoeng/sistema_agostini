<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    function index(Request $request) {
        $data = [
            'companies' => Company::inCompany(auth()->user())->orderBy('name')->get()
        ];
        return Inertia::render('Company/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Company $company) {
        return $this->createOrShowOrEdit($request, $company, 'show');
    }

    function edit(Request $request, Company $company) {
        return $this->createOrShowOrEdit($request, $company, 'edit');
    }

    function createOrShowOrEdit(Request $request, Company | null $company, String $context) {
        $data = [
            'context' => $context,
            'id' => $company->id ?? null,
            'name' => $company->name ?? null
        ];
        return Inertia::render('Company/Info', $data);
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
