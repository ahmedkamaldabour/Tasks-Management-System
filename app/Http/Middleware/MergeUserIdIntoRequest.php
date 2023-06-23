<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MergeUserIdIntoRequest
{
    /**
     * Handle an incoming request.
     *
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->merge(['user_id' => auth()->id()]);
        return $next($request);
    }
}
