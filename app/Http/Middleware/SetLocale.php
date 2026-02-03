<?php

namespace App\Http\Middleware;

use App\Services\LocalizationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $service = app(LocalizationService::class);
        $locale = $request->query('lang', $service->currentLocale());
        $service->setLocale($locale);

        return $next($request);
    }
}
