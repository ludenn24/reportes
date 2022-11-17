<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;


$app->group('', function () {   
    $this->get('/', 'HomeController:index')->setName('home');
    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('/auth', function () {
   
    $this->get('/dash', 'AdminController:getViewDash')->setName('auth.dash');
    $this->get('/reporte-migrantes', 'AdminController:getViewReporteMigrante')->setName('auth.migrantes');
    $this->get('/padron', 'AdminController:getViewPadron')->setName('auth.padon'); 
    $this->get('/padron/lista', 'AdminController:getPadron');
    $this->get('/padron/buscar', 'AdminController:getPadronUser');
    $this->get('/geo/migrantes', 'GeoController:GetMigrantes');
    $this->get('/signout', 'AdminController:getSignOut')->setName('auth.signout');
    $this->get('/listamenu', 'MenuCategoriaController:getMenuCategory');
    $this->get('/listaitem', 'MenuItemController:getMenuItem');
    $this->get('/voto/registrar', 'AdminController:ActualizarVoto');

})->add(new AuthMiddleware($container));
