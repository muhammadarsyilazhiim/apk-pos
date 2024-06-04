<?php

namespace App\Http\Middleware;

use Closure;

class ExecutionTimeLimit
{
    public function handle($request, Closure $next)
    {
        set_time_limit(120); // Mengatur batas waktu eksekusi menjadi 120 detik (2 menit)

        return $next($request);
    }
}