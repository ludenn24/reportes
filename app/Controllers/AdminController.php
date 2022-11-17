<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Controllers\Controller;
use App\Models\Padron;
use Illuminate\Http\Request;


Class AdminController extends Controller
{
    public function admin()
    {
        $ses_codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : '';
        $admin = Admin::where('codigo', $ses_codigo)->first();
        return $admin;
    }
    
    public function getViewDash($request, $response)
    {
        return $this->view->render($response, 'admin/dash.twig');
    }
   
    public function getViewReporteMigrante($request, $response)
    {
        return $this->view->render($response, 'admin/auth/reporte-migrante.twig');
    }
    
    public function getViewPadron($request, $response)
    {
        return $this->view->render($response, 'admin/auth/padron.twig');
    }
    
    public function validar($login, $clave)
    {
        $admin = Admin::where('login', $login)->first();
        if (!$admin) {
            return false;
        }
        if (password_verify($clave, $admin->clave)) {
            $_SESSION['codigo'] = $admin->codigo;
            $_SESSION['dni'] = $admin->dni;
            return true;
        }
        return false;
    }
    
    public function check()
    {
        return isset($_SESSION['dni']);
    }
    
     public function logout()
    {
        unset($_SESSION['dni']);
    }
    
    public function getSignOut($request, $response)
    {
        $this->AdminController->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');
    }

    public function getSignUp($request, $response)
    {

        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignIn($request, $response)
    {
        $auth = $this->AdminController->validar(
            $request->getParam('login'),
            $request->getParam('clave')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'El usuario o contraseña es incorrecto');
            return $response->withRedirect($this->router->pathFor('admin.signin'));
        }
        $this->flash->addMessage('info', 'Haz iniciado sesion correctamente');
        return $response->withRedirect($this->router->pathFor('admin.dash'));

    }
    
    public function getPadron($request, $response){
        try {
                $draw = $request->getParam('draw');
                $start = $request->getParam('start');
                $rowperpage = $request->getParam("length");
                $columnIndex_arr = $request->getParam('order');
                $columnName_arr = $request->getParam('columns');
                $order_arr = $request->getParam('order');
                $search_arr = $request->getParam('search');
                $columnIndex = $columnIndex_arr[0]['column']; // Column index
                $columnName = $columnName_arr[$columnIndex]['data']; // Column name
                $columnSortOrder = $order_arr[0]['dir']; // asc or desc
                $searchValue = $search_arr['value']; // Search value
                $totalRecords = Padron::select('count(*) as allcount')->count();
                $totalRecordswithFilter = Padron::select('count(*) as allcount')->where('dni', 'like', '%' .$searchValue . '%')->count();
                $records = Padron::
                        where('tb_electores.dni', 'like', '%' .$searchValue . '%')
                  ->select('tb_electores.*')
                  ->skip($start)
                  ->take($rowperpage)
                  ->get();

                $data_arr = array();

                foreach($records as $record){
                   $codigo= $record->codigo;
                   $voto= $record->voto;
                   $departamento = $record->departamento;
                   $provincia = $record->provincia;
                   $distrito = $record->distrito;
                   $dni = $record->dni;
                   $apepat = $record->apepat;
                   $apemat = $record->apemat;
                   $nombres = $record->nombres;

                   $data_arr[] = array(
                    "codigo" => $codigo,
                    "voto" => $voto,
                    "dni" => $dni,
                    "apepat" => $apepat,
                    "apemat" => $apemat,
                    "nombres" => $nombres,
                    "departamento" => $departamento,
                    "provincia" => $provincia,
                    "distrito" => $distrito,
                );
                }

                $response = array(
                   "draw" => intval($draw),
                   "iTotalRecords" => $totalRecords,
                   "iTotalDisplayRecords" => $totalRecordswithFilter,
                   "aaData" => $data_arr
                );

                echo json_encode($response);
                exit;
     
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function getPadronUser($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Padron::where('dni', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }
    
    public function ActualizarVoto($request, $response, $args) {
        
        try {
                $codigo = $request->getParam('codigo');
                Padron::where('codigo', '=', $codigo)->update([
                      'voto' => 'SI'
               ]);
              $mensaje['response'] = 'success';
              $mensaje['message'] = 'Elector registrado';
            echo json_encode($mensaje);
         } catch (ErrorException $e) {
              $mensaje['response'] = 'error';
              $mensaje['message'] = 'Ocurrió un error';
            echo json_encode($mensaje);
        }




    }

}
