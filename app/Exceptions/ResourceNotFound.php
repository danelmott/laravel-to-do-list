<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ResourceNotFound extends Exception
{
    public function __construct(string $resource = 'recurso')
    {
        return parent::__construct("{$resource} not found", 404);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 404);
    }
}
