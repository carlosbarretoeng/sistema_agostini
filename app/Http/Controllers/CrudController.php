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

class CrudController extends BaseController
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

    public function index(Request $request): Response
    {
        return Inertia::render($this->views['index'], $this->obterIndexData($request));
    }

    public function create(): Response
    {
        return Inertia::render($this->views['create'], $this->obterCreateData());
    }

    public function store(Request $request): RedirectResponse
    {
        $this->executarStore($request);
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
        $this->executarUpdate($request, $id);
        return Redirect::route($this->entity . '.index');
    }

    public function destroy($id)
    {
        $this->executarDestroy($id);
        return Redirect::route($this->entity . '.index');
    }

    public function obterForeignValues(array $fields)
    {
        foreach ($fields as $idx => $field) {
            if($field['type'] !== Field::FOREIGN_TYPE) continue;
            $fields[$idx]['values'] = array_map(function ($v) use ($field) {
                return [$v['id'], $v[$field['entity']::getDescription()]];
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

    public function obterIndexData(Request $request): array
    {
        $data = $this->model::all();
        $fields = call_user_func($this->model . '::getFields');
        $descriptionFieldName = $this->model::getDescription();
        $label = $this->label;
        $entity = $this->entity;

        return [
            'label' => $label,
            'data' => $data,
            'descriptionFieldName' => $descriptionFieldName,
            'fields' => $fields,
            'entity' => $entity
        ];
    }

    public function obterCreateData(): array
    {
        $fields = $this->obterForeignValues(call_user_func($this->model . '::getFields'));
        $label = $this->label;
        $entity = $this->entity;

        return [
            'label' => $label,
            'fields' => $fields,
            'entity' => $entity
        ];
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

    public function executarStore(Request $request)
    {
        $values = $request->all();
        $fields = call_user_func($this->model . '::getFields');

        $model = new ($this->model)();
        foreach ($fields as $field){
            $model[$field['name']] = $values[$field['name']];
        }

        return $model->save();
    }

    public function executarUpdate(Request $request, $id)
    {
        $values = $request->all();
        $fields = call_user_func($this->model . '::getFields');

        $model = call_user_func($this->model . '::find', $id);

        foreach ($fields as $field){
            $model[$field['name']] = $values[$field['name']];
        }

        return $model->save();
    }

    public function executarDestroy($id)
    {
        return call_user_func($this->model . '::destroy', $id);
    }
}
