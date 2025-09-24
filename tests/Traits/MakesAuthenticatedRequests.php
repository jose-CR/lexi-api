<?php

namespace Tests\Traits;

trait MakesAuthenticatedRequests
{
    /**
     * Ejecuta una request autenticada con JWT
     *
     * @param string $method  postJson, putJson, patchJson, deleteJson, getJson
     * @param string $url     La URL del endpoint
     * @param string $token   Token JWT del usuario
     * @param array|null $payload Datos a enviar (opcional)
     * @return \Illuminate\Testing\TestResponse
     */
    public function authJsonRequest(string $method, string $url, string $token, ?array $payload = null)
    {
        try {
            // Validar que sea un método soportado
            $supportedMethods = ['getJson', 'postJson', 'putJson', 'patchJson', 'deleteJson'];
            if (!in_array($method, $supportedMethods)) {
                throw new \InvalidArgumentException("Método HTTP no soportado: $method");
            }

            // Preparar la request con headers
            $request = $this->withHeaders([
                'Authorization' => "Bearer $token",
            ]);

            // Si el método soporta payload y se pasó, se lo agregamos
            if (in_array($method, ['postJson', 'putJson', 'patchJson'])) {
                return $request->$method($url, $payload ?? []);
            }

            // Métodos que no usan payload
            return $request->$method($url);

        } catch (\Exception $e) {
            // Opcional: lanzar una excepción más clara para los tests
            throw new \RuntimeException("Error ejecutando authJsonRequest: " . $e->getMessage());
        }
    }
}
