<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = [
            'Request Method' => $request->method(),
            'Request Path' => $request->path(),
            'Request Json' => $request->json(),
            'Request Params' => $request->all(),
            'Origin' => $request->headers->all(),
        ];

        Log::info(json_encode($data));

        return $next($request);
    }
}
