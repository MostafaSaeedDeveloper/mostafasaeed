<?php

namespace App\Http\Middleware;

use App\Services\LocalizationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function __construct(private readonly LocalizationService $localizationService)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $this->localizationService->setLocale($this->localizationService->currentLocale());

        return $next($request);
    }
}
