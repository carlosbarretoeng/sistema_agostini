<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private array $views = [
        'index' => 'CRUD/Index',
        'create' => 'CRUD/Create',
        'show' => 'CRUD/Show',
        'edit' => 'CRUD/Edit',
    ];

    public function __construct(
        private string $label,
        private string $entity,
        private string $model,
        null | array $viewMap = null
    )
    {
        if($viewMap != null) foreach ($viewMap as $action => $view) $this->registerView($action, $view);
    }

    public function index(): Response
    {
        $data = $this->model::all();
        $fields = call_user_func($this->model . '::getFields');
        $label = $this->label;
        $entity = $this->entity;
        return Inertia::render($this->views['index'], [
            'label' => $label,
            'data' => $data,
            'fields' => $fields,
            'entity' => $entity
        ]);
    }

    public function create(): Response
    {
        $fields = $this->obterForeignValues(call_user_func($this->model . '::getFields'));
        $label = $this->label;
        $entity = $this->entity;
        return Inertia::render($this->views['create'], [
            'label' => $label,
            'fields' => $fields,
            'entity' => $entity
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $values = $request->all();
        $fields = call_user_func($this->model . '::getFields');

        $model = new ($this->model)();
        foreach ($fields as $field){
            $model[$field['name']] = $values[$field['name']];
        }

        $model->save();

        return Redirect::route($this->entity . '.index');
    }

    public function show($id): Response
    {
        return $this->showOrEdit($id, 'show');
    }

    public function edit($id): Response
    {
        return $this->showOrEdit($id, 'edit');
    }

    public function update(Request $request, $id)
    {
        $values = $request->all();
        $fields = call_user_func($this->model . '::getFields');

        $model = call_user_func($this->model . '::find', $id);

        foreach ($fields as $field){
            $model[$field['name']] = $values[$field['name']];
        }

        $model->save();

        return Redirect::route($this->entity . '.index');
    }

    public function destroy($id)
    {
        call_user_func($this->model . '::destroy', $id);
        return Redirect::route($this->entity . '.index');
    }

    public function obterForeignValues(array $fields)
    {
        foreach ($fields as $idx => $field) {
            if($field['type'] !== Field::FOREIGN_TYPE) continue;
            $fields[$idx]['values'] = array_map(function ($v) use ($field) {
                return [$v['id'], $field['entity']::getDescription($v)];
            }, $field['entity']::all()->toArray());
        }

        return $fields;
    }

    private function registerView(string $action, string $vuePage) : void {
        $this->views[$action] = $vuePage;
    }

    private function showOrEdit($id, $route): Response
    {
        $data = $this->obterShowOrEditData($id, $route);
        return Inertia::render($this->views[$route], $data);
    }

    public function obterShowOrEditData($id, $route): array
    {
        $data = call_user_func($this->model . '::find', $id);
        $fields = $this->obterForeignValues(call_user_func($this->model . '::getFields'));
        $label = $this->label;
        $entity = $this->entity;

        return [
            'label' => $label,
            'data' => $data,
            'fields' => $fields,
            'entity' => $entity,
            'disabled' => $route === 'show'
        ];
    }
}
