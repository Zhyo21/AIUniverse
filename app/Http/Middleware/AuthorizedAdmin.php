<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Response;

class AuthorizedAdmin
{
    public function handle($request, Closure $next)
    {
        if (!$this->isAdmin($request)) {
            return redirect("/website");
        }

        return $next($request);
    }

    protected function isAdmin($request)
    {
        try {
            return $request->user()->admin == 1;
        } catch (Exception $e) {
            return false;
        }
    }
}
