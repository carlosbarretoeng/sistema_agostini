<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Machinery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class MachineryController extends Controller
{
    function index(Request $request) {
        $data = [
            'machineries' => Machinery::inCompany(auth()->user())->orderBy('name')->get()
        ];
        return Inertia::render('Machinery/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Machinery $machinery) {
        return $this->createOrShowOrEdit($request, $machinery, 'show');
    }

    function edit(Request $request, Machinery $machinery) {
        return $this->createOrShowOrEdit($request, $machinery, 'edit');
    }

    function createOrShowOrEdit(Request $request, Machinery | null $machinery, String $context) {
        $data = [
            'context' => $context,
            'id' => $machinery->id ?? null,
            'company_id' => $machinery->department->company_id ?? null,
            'department_id' => $machinery->department_id ?? null,
            'name' => $machinery->name ?? null,
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
            'departments' => Department::inCompany(auth()->user())->get(['id', 'name', 'company_id']),
        ];
        return Inertia::render('Machinery/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'department_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('machinery.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $machinery = new Machinery();

            $machinery->department_id = $attrs['department_id'];
            $machinery->name = $attrs['name'];

            $machinery->save();

            return Redirect::route('machinery.index');
        }
    }

    function update(Request $request) {
        $rules = [
            'id' => 'required',
            'department_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('machinery.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $machinery = Machinery::find($attrs['id']);

            $machinery->department_id = $attrs['department_id'];
            $machinery->name = $attrs['name'];

            $machinery->save();

            return Redirect::route('machinery.index');
        }
    }

    function destroy(Request | null $request, Machinery $machinery){
        $machinery->delete();
        return Redirect::route('machinery.index');
    }
}
