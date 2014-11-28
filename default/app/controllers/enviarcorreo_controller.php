<?php
Load::lib('PHPMailer/PHPMailerAutoload');
class EnviarcorreoController extends AppController {

    public function correo() {
        View::template('sbadmin');
        if(Input::hasPost('correo')){
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
        
    }

    public function enviar() {
        View::template('sbadmin');
        
        
        /*$mail = new PHPMailer();
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
        $mail->Subject = $_POST['asunto'];
        $mail->msgHTML();
        //$address = "steeven@unicauca.edu.co";
        $mail->addAddress($correo, "Ruiz Steven");*/
    }

}
