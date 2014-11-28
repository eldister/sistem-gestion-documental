<?php
Load::lib('PHPMailer/PHPMailerAutoload');
Load::lib('auth');
class RestaurarcuentaController extends AppController{
    
    function restaurarcuenta(){
        View::template('login-box');
      if(Input::hasPost('correo')){
        $resultado = $usuario->find_by_email("$email");
        echo "Error al enviar: ";
       }
       echo "Error al enviar: ";
         /*if(Input::hasPost('correo')){
            //print_r($_POST);
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
            $mail->Subject = $_POST['correo']['asunto'];
            $mail->msgHTML($_POST['correo']['mensaje']);
            //$address = "steeven@unicauca.edu.co";
            $mail->addAddress($_POST['correo']['destinatarios'], "...");
            if (!$mail->send()) {
                echo "Error al enviar: " . $mail->ErrorInfo;
            }
            Input::delete();
        }     
       // */
        
    }
    
    function solicitudexitosa(){
        View::template('login-box');        
    }
    
    public function regresar(){
        Router::redirect("usuario/ingresar");
    }
    
    public function cancelar(){
        Router::redirect("usuario/ingresar");
    }
    
     public function actualizardatos(){
        View::template('login-box');
        
    }
}
