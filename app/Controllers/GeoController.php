<?php

namespace App\Controllers;

use App\Models\Geo;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class GeoController extends Controller {

    public function GetMigrantes($request, $response, $args) {
        try {
            $data = Geo::select('tb_geo.*','tb_programa.nombre','tb_programa.programa_id')
                    ->join('tb_programa','tb_geo.programa_id','tb_programa.programa_id')
                    ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

}
