<?php

namespace App\Http\Middleware;use Closure;

use Exception;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class JwtMiddleware extends BaseMiddleware

{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {

        try {

            $user = auth('api')->check();

            if(!$user) throw new Exception('Não autorizado!!!');

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                    return response()->json([
                            'data' => null,
                            'status' => false,
                            'errors' => 'Token Inválido',
                            'code' => 1
                        ],
                        JsonResponse::HTTP_BAD_REQUEST
                    );

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return response()->json([
                        'data' => null,
                        'status' => false,
                        'errors' => 'Token Expirado',
                        'code' => 1
                    ],
                    JsonResponse::HTTP_UNAUTHORIZED
                );

            }
            else{

                if($e->getMessage() === 'Não autorizado!!!') {
                    return response()->json([
                            "data" => null,
                            "status" => false,
                            'errors' => 'Não autorizado!!!',
                            'code' => 1
                        ],
                        JsonResponse::HTTP_UNAUTHORIZED
                    );
                }

                return response()->json([
                        'data' => null,
                        'status' => false,
                        'errors' => 'Token não encontrado.',
                        'code' => 1
                    ],
                    JsonResponse::HTTP_NOT_FOUND
                );

            }

        }

        return $next($request);

    }

}