<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Obtenemos el api-key que el usuario envia
        $key = $request->headers->get('key');
        // dd($request->headers);
        $localKey = '$2y$10$iev36jyXXaAWKnvOpA9.8OHZGqsSh7aNEWe4I3LNCWrBXCUG6z0JC';
        // Si coincide con el valor almacenado en la aplicacion
        // la aplicacion se sigue ejecutando
        // String ="base64:i2WYsFDex2X0watDA9iBdt2+zkecUS26A8+F5NI2NdM=" puede ser comparado con los guardado en las bases de dados
        if (isset($key) && $key == $localKey) {
            return $next($request);
        } else {
            // Si falla devolvemos el mensaje de error
            return response()->json(['error' => 'unauthorized' ], 401);
        }
    }
}
