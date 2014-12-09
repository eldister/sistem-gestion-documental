<?php
Load::model('usuario');
class EstadisticasController extends AppController {
    
    public function index(){
        
        //View::template('sbadmin');
        $Usuario = new Usuario();
        $vector[][] = null;        
        $fila = -1;
        foreach($Usuario->find_all_by_sql("select * from usuario where fechanacimiento_at between '2014-03-14' and '2014-12-19'") as $usuario){
            $col = 0;
            $vector[$fila += 1][$col] = $usuario->nombre;
            $vector[$fila][$col += 1] = $usuario->apellido;
        }
        print_r($vector);
    }
    
    public function docmasleidos(){
        
        View::template('sbadmin');
        
        
    }

}