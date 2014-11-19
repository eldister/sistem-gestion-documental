<?php

Load::model('usuario');
load::lib('PHPMailer/class.phpmailer');
class RegistroController extends AppController {
    
    
    public function index(){
         $usuario = new Usuario(); 
       
    }
    
    public function crear(){
        //print_r($_POST);// exit();
       // print_r($_POST);
        View::template('registro_usuario'); 
        $this->titulo = "Crear Usuario"; // titulo a mostrar
        
        /**
        * Se verifica si el usuario envio el form (submit) y si ademas
        * dentro del array POST existe uno llamado "menus"
        * el cual aplica la autocarga de objeto para guardar los
        * datos enviado por POST utilizando autocarga de objeto
        */
        if(Input::hasPost('Usuario')){     
            $con = (md5($_POST['Usuario']['contrasena']));
        $com = (md5($_POST['CONFIRMAR_CONTRASENA']));
        //print_r($con);
        $_POST['CONFIRMAR_CONTRASENA'] = $com;
        $_POST['Usuario']['contrasena'] = $con;
           /**
            * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
            * y los asocia al campo correspondiente siempre y cuando se utilice la convención
            * model.campo
            */
           //print_r($_POST);
           $Usuario = new Usuario(Input::post('Usuario'));
           $Usuario->initialize();             
           //En caso que falle la operación de guardar
           if($_POST['Usuario']['contrasena'] == $_POST['CONFIRMAR_CONTRASENA'])
            {               
                if(!$Usuario->save()){
                    Flash::error('Falló Operación');
                }else{
                    Flash::valid('Operación exitosa');
                    //Eliminamos el POST, si no queremos que se vean en el form
                    Input::delete();
                    //enrutando por defecto al index del controller
                    return Router::redirect("registro/registroexitoso");
                }              
            }else
            {
                Flash::error('Las contraseñas no coinciden');
            }
       }
    }
    
    public function regresar(){
        Router::redirect("usuario/ingresar");
    }
    
     public function registroexitoso() 
    {
    $this->titulo = "Usuario Registrado";
    View::template('registro_usuario'); 
    }

}