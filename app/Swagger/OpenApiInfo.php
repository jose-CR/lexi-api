<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Lexi API",
 *     description="Documentación de endpoints"
 * )
 * @OA\Server(
 *     url="http://localhost:8000/api/v1",
 *     description="Servidor local"
 * )
*/
class OpenApiInfo
{
    // Esta clase puede quedarse vacía; solo sirve para contener las anotaciones
}
