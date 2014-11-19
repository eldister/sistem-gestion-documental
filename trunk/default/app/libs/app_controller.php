<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{

    final protected function initialize()
    {
        View::template('sbadmin'); /// para el template, todos los controladores que invoquen el appcontroller se va a invocar la plantilla
        //esto evita que en cada controlador se haga llamado de la  plantilla
        //Si en otro controlador hago llamado a otra plantilla, se sobreescribira esta linea

    }

    final protected function finalize()
    {
        
    }

}
