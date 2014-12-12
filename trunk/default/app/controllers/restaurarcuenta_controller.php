<?php
Load::lib('PHPMailer/PHPMailerAutoload');
Load::lib('auth');
Load::model('Usuario');
class RestaurarcuentaController extends AppController{
    
    public function restaurarcuenta(){
        View::template('sbadmin');
        
        if(Input::hasPost('correo')){
            $Usuario = new Usuario();
            $direccion = $_POST['correo']['email'];
            if("SELECT count(*) FROM usuario WHERE email = '$direccion'" == 1){
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
                $mail->Subject = "asunto";
                $mail->msgHTML("mensaje");
                //$address = "steeven@unicauca.edu.co";
                $mail->addAddress($_POST['correo']['email'], "...");
                if (!$mail->send()) {
                    echo "Error al enviar: " . $mail->ErrorInfo;
                }
                Input::delete();
            }else{
                print_r("No hay cuenta asociada al correo digitado");
            }         
        }       
    }
    
    public function solicitudexitosa(){
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
