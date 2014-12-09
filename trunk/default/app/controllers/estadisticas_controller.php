<?php
Load::model('usuario');
class EstadisticasController extends AppController {
    
    public function index(){
        
        View::template('default');
        $Usuario = new Usuario();
        foreach($Usuario->find_all_by_sql("select * from usuario where fechanacimiento_at between '2014-03-14' and '2014-12-19'") as $usuario){
            print_r($usuario->nombre);
        }
        print_r($usuario->array[0][2]);
    }
    
    public function ejemplo(){
        
        View::template('sbadmin');
        
    }

}