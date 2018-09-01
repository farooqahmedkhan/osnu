<?php

namespace App\Http\Middleware;

use Closure;

class cors {
    public function handle($request, Closure $next)
    {        
        $response = $next($request);
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
        $headers = [            
            'Access-Control-Allow-Origin' => '*'
            , 'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS'
            , 'Access-Control-Max-Age' => '1000'
            , 'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With'
        ];

        if($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
            return $response;
        }

        if($response instanceof $SymfonyResopnse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            return $response;
        }

        return $response;
    }
}