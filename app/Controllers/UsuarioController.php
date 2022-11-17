<?php

namespace App\Controllers;

use App\Models\Formulario;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class UsuarioController extends Controller {

    public function Listar($request, $response, $args) {
        try {
            $data = Formulario::where('estado', '!=', 3)
                    ->orderBy('id', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }


}
