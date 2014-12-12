<?php

//Config::set('config.application.breadcrumb', true); // Habilitar la miga de pan

class AdministradorController extends AppController{
    
    function inicioadmin(){
     
        
        View::template('sbadmin');
        $usuaior=Auth::get('id');
        
    }
}
