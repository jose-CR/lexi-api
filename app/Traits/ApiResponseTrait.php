<?php

namespace App\Traits;

use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ApiResponseTrait
{

    protected function successResponse(string $message, mixed $data = null, int $code = 200, string $color = 'green'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'color' => $color,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(string $message, mixed $data = null, int $code = 500, string $color = 'red'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'color' => $color,
            'message' => $message,
        ], $code);
    }

    protected function exceptionResponse(Exception $e, string $customMessage = '❌ Ocurrió un error inesperado.'): JsonResponse
    {
        Log::error($e->getMessage());

        return $this->errorResponse($customMessage, 500);
    }

    /**
     * Respuesta estándar para colecciones paginadas
    */
    protected function paginatedResponse(LengthAwarePaginator $paginator, string $message = '✅ Lista obtenida correctamente.', int $code = 200): JsonResponse
    {
        return $this->successResponse($message, [
            'info' => [
                'count' => $paginator->total(),
                'pages' => $paginator->lastPage(),
                'next' => $paginator->nextPageUrl(),
                'prev' => $paginator->previousPageUrl(),
            ],
            'data' => $paginator->getCollection(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
                'last_page' => $paginator->lastPage(),
                'total' => $paginator->total(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
                'last' => $paginator->url($paginator->lastPage()),
            ],
        ], $code);
    }
}