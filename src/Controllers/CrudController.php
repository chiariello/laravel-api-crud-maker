<?php

namespace Chiariello\LaravelApiCrudMaker\Controllers;

use Chiariello\LaravelApiCrudMaker\Filters\AbstractFilters;
use Chiariello\LaravelApiCrudMaker\Requests\AbstractRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CrudController extends ApiController
{
    protected string $model;
    protected string $orderBy = 'id';

    /**
     * Campo di ricerca per il metodo index()
     * @var string
     * @see index()
     */


    public function __construct()
    {
    }

    public function list(AbstractFilters $filter, Request $request): JsonResponse
    {
        $model = $this->model::filter($filter);
        if($request->entries){
            return $this->paginatedSuccessResponse($model->paginate($request->entries));
        }
        return $this->successResponse($model->get());
    }

    public function store(AbstractRequest $request)
    {
        return $this->successResponse($request->persist());
    }

    public function show($id) : JsonResponse
    {
        return $this->successResponse($this->model::findOrFail($id));
    }

    public function update(AbstractRequest $request) : JsonResponse
    {
        return $this->successResponse($request->persist());
    }

    public function destroy($id) : JsonResponse
    {
        return $this->successResponse($this->model::findOrFail($id)->delete());
    }

}
