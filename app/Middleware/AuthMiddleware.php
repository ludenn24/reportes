<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        //check si el usuario inicio sesion
        if (!$this->container->AuthController->check()) {
            $this->container->flash->addMessage('error', 'Ustede debe iniciar sesión');
            return $response->withRedirect($this->container->router->pathfor('home'));
        }

        $response = $next($request, $response);
        
        return $response;

    }
}
