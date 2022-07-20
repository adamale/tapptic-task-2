<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function resourceResponse(
        JsonResource $resource,
        bool $success = true,
        ?string $message = null
    ): JsonResource {
        return $resource->additional(compact('success', 'message'));
    }

    protected function jsonResponse(bool $success, array $data = [], ?string $message = null): JsonResponse
    {
        return response()->json(compact('data', 'success', 'message'));
    }

    protected function jsonSuccessResponse(array $data = [], ?string $message = null): JsonResponse
    {
        return $this->jsonResponse(true, $data, $message);
    }
}
