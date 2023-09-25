<?php

namespace Chiariello\LaravelApiCrudMaker\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser{

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function paginatedSuccessResponse(LengthAwarePaginator $response, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success',
            'message' => $message,
            'current_page'=>$response->currentPage(),
            'last_page'=>$response->lastPage(),
            'per_page'=>$response->perPage(),
            'total'=>$response->total(),
            'data' => $response->items()
        ], $code);
    }

    protected function errorResponse($message = null, $code)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }

}
