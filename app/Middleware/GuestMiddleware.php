<?php

namespace App\Middleware;

class GuestMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {

        if ($this->container->AdminController->check()) {
            return $response->withRedirect($this->container->router->pathFor('auth.dash'));
        }

        $response = $next($request, $response);
        return $response;

    }
}
