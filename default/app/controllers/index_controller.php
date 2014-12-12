<?php

/**
 * Controller por defecto si no se usa el routes
 * 
 */
//Config::set('config.application.breadcrumb', true); //miga de pan
//Config::set('config.application.breadcrumb', true);
class IndexController extends AppController
{

    public function index()
    {
        //$this->titulo = "Bienvenido Administrador"; // titulo a mostrar
        View::template('login-box'); /// para el template, todos los controladores que invoquen el appcontroller se va a invocar la plantilla
        //esto evita que en cada controlador se haga llamado de la  plantilla login-box
        //Si en otro controlador hago llamado a otra plantilla, se sobreescribira esta linea 

        
    }

}
