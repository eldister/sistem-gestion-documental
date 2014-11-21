<?php

Load::models('usuario');

class UsuariocrudController extends AppController {

    public function index($page = 1) {

        $this->titulo = "Bienvenidos a Usuario"; // Pasa el titulo de la pagina

        $usuario = new Usuario();
        // $this->listEmpleado = $empleado->getEmpleado($page);
        $this->inner = $usuario->getUsuarios($page);

        //$this->create();
    }

    public function edit($id) {
        $usuario = new Usuario();

        $this->titulo = "Editar Usuario";
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Usuario')) {

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
            return Router::redirect("administrador/inicioadmin", '3');
            
        }
    }

}
