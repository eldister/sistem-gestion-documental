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
    public $acl; //variable objeto ACL
	public $userRol = ""; //variable con el rol del usuario autenticado en la aplicación
        

    final protected function initialize()
    {
        View::template('sbadmin'); /// para el template, todos los controladores que invoquen el appcontroller se va a invocar la plantilla
        //esto evita que en cada controlador se haga llamado de la  plantilla
        //Si en otro controlador hago llamado a otra plantilla, se sobreescribira esta linea
        if(Auth::is_valid()) $this->userRol = Auth::get("rol");
               
 
		$this->acl = new Acl();
		//Se agregan los roles
		$this->acl->add_role(new AclRole('lector')); // Visitantes
		$this->acl->add_role(new AclRole('editor')); // Administradores
		$this->acl->add_role(new AclRole('administrador')); // Usuarios
                $this->acl->add_role(new AclRole(''));
 
		//Se agregan los recursos osea todos los controladores con sus funciones
                $this->acl->add_resource(new AclResource('usuario'), 'ingresar');
		$this->acl->add_resource(new AclResource('usuariocrud'),'index','edit');
                $this->acl->add_resource(new AclResource('registro'),'index','crear');
                
		 
 
		//Se crean los permisos osea va 'tipoUsuario o rol','nombre_controlador' array('funcion1','funcion2','y las que quieran')
		 // Inicio
		$this->acl->allow('administrador', 'usuariocrud', array('index','edit'));
                $this->acl->allow('administrador', 'registro', array('index','crear'));
		$this->acl->allow('editor','usuariocrud', array('edit'));
                $this->acl->allow("lector", 'usuariocrud', array('index'));
                $this->acl->allow('', 'usuario', array('ingresar'));

    }

    final protected function finalize()
    {
        
    }

}
