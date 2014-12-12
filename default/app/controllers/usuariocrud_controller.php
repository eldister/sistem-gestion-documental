<?php

Load::models('usuario');
Load::model('carpeta');
Config::set('config.application.breadcrumb', true);

class UsuariocrudController extends AppController {

    public function index($page = 1) {

        $this->titulo = "Bienvenidos a Usuario"; // Pasa el titulo de la pagina
         $this->titulo2 = "";//pasa la ubicacion
           $this->usuaior=Auth::get('nombre');
        $usuario = new Usuario();

        $valorencombo = $_POST["region"]; //supuestamente asi se saca el valor que selecciono en el combo box del index. este deberia ser el que se le pasa a getUsuarios para que los busquye
        $this->inner = $usuario->getUsuarios($page, $valorencombo);
    }

    public function edit($id) {
        $usuario = new Usuario();

        $this->titulo = "Editar Usuario";
         $this->titulo2 = "";
           $this->usuaior=Auth::get('nombre');
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Usuario')) {
            if ($_POST['Usuario']['rol'] == 'administrador' or $_POST['Usuario']['rol'] == 'editor') {
                //Al directorio public hay que darle premisos 777
                $carpeta=new Carpeta(); 
               $nombrecarpe = $_POST['Usuario']['nombreusuario']; // crea una careta en default puplic
                $carpetaid_contenedor=NULL;
               $carpeta-> insertar_carpeta_editar($carpetaid_contenedor,$nombrecarpe) ;

                if (!file_exists($nombrecarpe)) {
                    if (!mkdir($nombrecarpe, 0777, true)) {
                        die('Fallo al crear las carpetas...');
                    }
                }
            }

            if (!$usuario->update(Input::post('Usuario'))) {
                Flash::error('Falló Operación');
            } else {
                Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Router::redirect();
            }
        } else {
            //Aplicando la autocarga de objeto, para comenzar la edición
            $this->Usuario = $usuario->find((int) $id);
        }
    }

    protected function before_filter() {
        // Verificando si el rol del usuario actual tiene permisos para la acción a ejecutar
        if (!$this->acl->is_allowed($this->userRol, $this->controller_name, $this->action_name)) {
            Flash::error("Acceso negado");
            return  Router::redirect("usuario/ingresar");
        }
    }

}
