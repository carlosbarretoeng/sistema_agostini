<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Machinery;
use App\Models\Part;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PartController extends Controller
{
    function index(Request $request) {
        $data = [
            'parts' => Part::inCompany(auth()->user())->orderBy('name')->get()
        ];
        return Inertia::render('Part/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Part $part) {
        return $this->createOrShowOrEdit($request, $part, 'show');
    }

    function edit(Request $request, Part $part) {
        return $this->createOrShowOrEdit($request, $part, 'edit');
    }

    function createOrShowOrEdit(Request $request, Part | null $part, String $context) {
        $data = [
            'context' => $context,
            'id' => $part->id ?? null,
            'company_id' => $part->company_id ?? null,
            'machinery_id' => $part->machinery_id ?? null,
            'name' => $part->name ?? null,
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
            'machineries' => Machinery::inCompany(auth()->user())->get(['id','name']),
        ];
        return Inertia::render('Part/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'company_id' => 'required',
            'machinery_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('department.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $part = new Part();

            $part->company_id = $attrs['company_id'];
            $part->machinery_id = $attrs['machinery_id'];
            $part->name = $attrs['name'];

            $part->save();

            return Redirect::route('part.index');
        }
    }

    function update(Request $request) {
        $rules = [
            'id' => 'required',
            'company_id' => 'required',
            'machinery_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('department.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $part = Part::find($attrs['id']);

            $part->company_id = $attrs['company_id'];
            $part->machinery_id = $attrs['machinery_id'];
            $part->name = $attrs['name'];

            $part->save();

            return Redirect::route('part.index');
        }
    }

    function destroy(Request | null $request, Part $part){
        $part->delete();
        return Redirect::route('part.index');
    }
}
