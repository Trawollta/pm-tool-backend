<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param
     */
    public function handle(Request $request, Closure $next): Response
{
    $headers = [
        'Access-Control-Allow-Origin'      => 'http://localhost:4200',
        'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With, Accept, Origin',
        'Access-Control-Allow-Credentials' => 'true'
    ];

    // Preflight-Request (OPTIONS) abfangen
    if ($request->getMethod() === "OPTIONS") {
        return response('', 204)->withHeaders($headers);
    }

    $response = $next($request);
    foreach ($headers as $key => $value) {
        $response->headers->set($key, $value);
    }

    return $response;
}

}
