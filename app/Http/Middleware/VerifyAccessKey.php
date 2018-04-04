<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;

class VerifyAccessKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed $2y$10$8Gvd3pxUWWUY88OFDrX7peYDlMAp5EftAh3Pt3T01MSdbC1HBSQX6
     */
    public function handle($request, Closure $next)
    {
        // Obtenemos el api-key que el usuario envia
        $key = $request->headers->get('api_key');
        // Si coincide con el valor almacenado en la aplicacion
        // la aplicacion se sigue ejecutando
        $regist=false;
        $tokens = Token::all();
        foreach($tokens as $token){
            if($token==isset($key)){
                $regist=true;
            }
        }
        if ($regist==true) {
            return $next($request);
        } else {
            // Si falla devolvemos el mensaje de error
            return response()->json(['error' => 'unauthorized' ], 401);
        }
    }
}
