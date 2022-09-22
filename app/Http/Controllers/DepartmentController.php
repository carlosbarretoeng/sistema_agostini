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
            'departaments' => Department::orderBy('name')->get()
        ];
        return Inertia::render('Departament/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Department $departament) {
        return $this->createOrShowOrEdit($request, $departament, 'show');
    }

    function edit(Request $request, Department $departament) {
        return $this->createOrShowOrEdit($request, $departament, 'edit');
    }

    function createOrShowOrEdit(Request $request, Department | null $departament, String $context) {
        $data = [
            'context' => $context,
            'id' => $departament->id ?? null,
            'company_id' => $departament->company_id ?? null,
            'name' => $departament->name ?? null,
            'companies' => Company::all(['id','name']),
        ];
        return Inertia::render('Departament/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'company_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('departament.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $departament = new Department();

            $departament->company_id = $attrs['company_id'];
            $departament->name = $attrs['name'];

            $departament->save();

            return Redirect::route('departament.index');
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
            return Redirect::route('departament.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $departament = Department::find($attrs['id']);

            $departament->company_id = $attrs['company_id'];
            $departament->name = $attrs['name'];

            $departament->save();

            return Redirect::route('departament.index');
        }
    }

    function destroy(Request $request, Department $departament){
        $departament->machineries()->delete();
        $departament->delete();
        return Redirect::route('departament.index');
    }
}
