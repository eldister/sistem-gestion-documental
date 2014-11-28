<?php

class RestaurarcuentaController extends AppController{
    
    function restaurarcuenta(){
        View::template('login-box');
       // Load::lib('auth');
        
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
