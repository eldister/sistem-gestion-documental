<?php

Load::model('usuario');
load::lib('PHPMailer/PHPMailerAutoload');

class RegistroController extends AppController {
    
    
    public function index(){
         $usuario = new Usuario(); 
       
    }
   /* protected function before_filter() {
       // Verificando si el rol del usuario actual tiene permisos para la acción a ejecutar
       if (!$this->acl->is_allowed($this->userRol, $this->controller_name, $this->action_name)) {
           Flash::error("Acceso negado");
           return false;
       }
    }*/
    
    public function crear(){
        View::template('login-box'); 
        $this->titulo = "Crear Usuario"; // titulo a mostrar        
        /**
        * Se verifica si el usuario envio el form (submit) y si ademas
        * dentro del array POST existe uno llamado "menus"
        * el cual aplica la autocarga de objeto para guardar los
        * datos enviado por POST utilizando autocarga de objeto
        */
        if(Input::hasPost('Usuario')){            
           /**
            * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
            * y los asocia al campo correspondiente siempre y cuando se utilice la convención
            * model.campo
            */
           //print_r($_POST);                        
           //En caso que falle la operación de guardar
           if($_POST['Usuario']['contrasena'] == $_POST['CONFIRMAR_CONTRASENA'])
            {
               if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['Usuario']['contrasena'] ))
               {
                    $con = (md5($_POST['Usuario']['contrasena']));
                    $com = (md5($_POST['CONFIRMAR_CONTRASENA']));
                    $_POST['CONFIRMAR_CONTRASENA'] = $com;
                    $_POST['Usuario']['contrasena'] = $con;
                    $correo = $_POST['Usuario']['email'];
                    $nombre = $_POST['Usuario']['nombre'] + $_POST['Usuario']['apellido'];
                    $Usuario = new Usuario(Input::post('Usuario'));
                    $Usuario->initialize();
                    if(!$Usuario->save()){
                        Flash::error('Falló Operación');
                    }else{
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        //$mail­>SMTPDebug = 2;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 465;
                        $mail->Username = "gestiondocumentalpis@gmail.com";
                        $mail->Password = "unicaucapis";
                        $mail->setFrom('gestiondocumentalpis@gmail.com', 'Gestión Documental');
                        //$mail­>AddReplyTo("ruizcsteven@gmail.com", "Steven Ruiz");
                        $mail->Subject = "Resgistro en Sistema Gesti&oacute;n Documental PIS";
                        $mail->msgHTML("https://localhost/trunk/usuario/ingresar");
                        //$address = "steeven@unicauca.edu.co";
                        $mail->addAddress($correo, $nombre);
                        if (!$mail->send()) {
                            echo "Error al enviar: " . $mail->ErrorInfo;
                        }
                        //Eliminamos el POST, si no queremos que se vean en el form
                        Input::delete();
                        return Router::redirect("registro/registroexitoso");
                    }
               }else{
                   Flash::error('La contraseña debe contener mínimo 8 caracteres, debe incluir una mayúscula');
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