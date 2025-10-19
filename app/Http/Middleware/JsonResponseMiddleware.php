<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseMiddleware
{
    protected const string CONTENT_TYPE = 'application/json';

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', static::CONTENT_TYPE);
            
            try {
                $response = $next($request);
                $response->headers->set('Content-Type', static::CONTENT_TYPE);

                if (is_object($response) && property_exists($response, 'exception'))
                    if (is_object($response->exception))
                        throw $response->exception;
                    elseif (property_exists($response, 'message'))
                        throw new \Exception($response->message);
                
                return $response;
                
            } catch (\Throwable $e) {
                return response()->json(['error' => $e->getMessage()], $this->getStatusCode($e));
            }
        }

        return $next($request);
    }
    
    private function getStatusCode(\Throwable $e): int
    {
        if (method_exists($e, 'getStatusCode')) return $e->getStatusCode();
        if ($e instanceof \Illuminate\Validation\ValidationException) return 422;
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) return 404;

        return 400;
    }
}