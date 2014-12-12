<?php
Load::model('documento');
class EstadisticasController extends AppController {
    
    public function index(){
        $this->titulo = 'Estadisticas';
        View::template('sbadmin');
        
    }
    
    public function docmasleidos(){
        $this->titulo = 'Estadisticas';
        View::template('sbadmin');
        if(Input::hasPost('estadistica'))
        {
            $inicio = $_POST['estadistica']['inicio'];
            $fin = $_POST['estadistica']['fin'];
            $documento=new Documento();
            $this->doc=$documento->lecturas($pages=1,$inicio, $fin);
           //print_r($documento);
        }
        
        //print_r($data);
    }
}