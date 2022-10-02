<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    function index(Request $request) {
        $data = [
            'departments' => Department::inCompany(auth()->user())->orderBy('name')->get()
        ];
        return Inertia::render('Department/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Department $department) {
        return $this->createOrShowOrEdit($request, $department, 'show');
    }

    function edit(Request $request, Department $department) {
        return $this->createOrShowOrEdit($request, $department, 'edit');
    }

    function createOrShowOrEdit(Request $request, Department | null $department, String $context) {
        $data = [
            'context' => $context,
            'id' => $department->id ?? null,
            'company_id' => $department->company_id ?? null,
            'name' => $department->name ?? null,
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
        ];
        return Inertia::render('Department/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'company_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('department.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $departments = new Department();

            $departments->company_id = $attrs['company_id'];
            $departments->name = $attrs['name'];

            $departments->save();

            return Redirect::route('department.index');
        }
    }

    function update(Request $request) {
        $rules = [
            'id' => 'required',
            'company_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('department.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $departments = Department::find($attrs['id']);

            $departments->company_id = $attrs['company_id'];
            $departments->name = $attrs['name'];

            $departments->save();

            return Redirect::route('department.index');
        }
    }

    function destroy(Request | null $request, Department $department){
        foreach ($department->machineries as $machinery) {
            (new MachineryController())->destroy(null, $machinery);
        }

        $department->delete();
        return Redirect::route('department.index');
    }
}
