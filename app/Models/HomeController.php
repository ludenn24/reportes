<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

Class  HomeController extends Controller
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
    
        public function getViewRegistro($request, $response)
    {
        return $this->view->render($response, 'templates/registro.twig');
    }
    
   public function getViewGeo($request, $response)
    {
        return $this->view->render($response, 'templates/geo.twig');
    }
    
   public function getViewBusca($request, $response)
    {
        return $this->view->render($response, 'templates/encuentra.twig');
    }
    
    public function Reportes($request, $response)
    {
        return $this->view->render($response, 'templates/reportes.twig');
    }

}
