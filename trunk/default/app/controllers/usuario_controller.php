<?php
Load::model('usuario');
//Config::set('config.application.breadcrumb', FALSE);

/*class UsuarioController extends  ScaffoldController{
    
public $model = 'usuario';
}
?>*/
    
    class UsuarioController extends ApplicationController
    {
        
	
	public function index() 
	{
	    
	}
	
	function ingresar()
	{
            Config::set('config.application.breadcrumb', FALSE);
            View::template('login-box'); 
            Load::lib('auth');
	    
            if ($this->has_post("usuario","contrasena"))
	    {
                
		$usuario = $this->post("usuario");
		$contrasena = $this->post("contrasena");
                
                $auth = new Auth("model", "class: Usuario", "nombreusuario: $usuario", "contrasena: $contrasena");
                
                if ($auth->authenticate())
                {
                    Router::redirect("administrador/inicioadmin");
                    //Flash::success("Correcto");
                } 
                else 
                {
                    Flash::error("FallÃ³");
                }
            }
        }
        public function validateCredentialsAction(){
             $rules = array(
                            "email" => array(
                            "filter" => "alpha",
                            "message" => "Por favor indique su correo electronico
                             "),
                            "password" => array(
                             "filter" => "int",
                             "message" => "Por favor indique su contraseña"
                              ),
                 );
          if($this->validateRequired($rules)==true){
//Aquí viene la autenticación
            } else {
             $this->routeTo("action: ingresar");
              }
        }
        
        public function restaurar(){
            Router::redirect("restaurarcuenta/restaurarcuenta");
        }
        
        public function crear(){
            Config::set('config.application.breadcrumb', FALSE);
            Router::redirect("registro/crear");
        }
        public function salir() {
            //Load::lib('auth');
            Auth::destroy_identity();
            Router::redirect("usuario/ingresar");
            
        }
    }





