<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private array $views = [
        'index' => 'CRUD/Index',
        'create' => 'CRUD/Create',
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

    public function create()
    {
        $fields = call_user_func($this->model . '::getFields');
        $fields = $this->obterForeignValues($fields);
        $label = $this->label;
        $entity = $this->entity;
        return Inertia::render($this->views['create'], [
            'label' => $label,
            'fields' => $fields,
            'entity' => $entity
        ]);
    }

    /* public function store(StoreEmpresaRequest $request)
    {
        //
    }*/

    public function show(Model $model_)
    {
        //
    }

    public function edit(Model $model_)
    {
        //
    }

    /* public function update(UpdateEmpresaRequest $request, Model $model)
    {
        //
    }*/

    public function destroy(Model $model_)
    {
        //
    }

    private function registerView(string $action, string $vuePage) : void {
        $this->views[$action] = $vuePage;
    }

    private function obterForeignValues(array $fields)
    {
        foreach ($fields as $idx => $field) {
            if($field['type'] !== Field::FOREIGN_TYPE) continue;
            $fields[$idx]['values'] = array_map(function ($v) use ($field) {
                return [$v['id'], $field['entity']::getDescription($v)];
            }, $field['entity']::all()->toArray());
        }

        return $fields;
    }
}
