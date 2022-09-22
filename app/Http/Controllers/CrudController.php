<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CrudController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(
        private string $label,
        private string $routeName,
        private string $modelName
    ){}

    private function returnToView(string $viewName, mixed $data): Response
    {
        return Inertia::render('Crud/' . $viewName, $data);
    }

    public function getDefaultData(Request $request): mixed {
        return [
            'label' => $this->label,
            'routeName' => $this->routeName,
            'data' => $this->modelName::all()
        ];
    }

    function index(Request $request) {
        return $this->returnToView('Index', $this->getDefaultData($request));
    }
}
