<?php
Load::model('Documento');
class documentoController extends AppController{
     
    public function creardoc()
    {
         View::content('creardoc');
         if(Input::hasPost('Documento')){
         $descripcion = $_POST['Documento']['DESCRIPCION'];
         $nombre = $_POST['Documento']['NOMBREDOCUMENTO'];
         $folio = $_POST['Documento']['FOLIO'];
         $fechapublicacion = $_POST['Documento']['FECHAPUBLICACION_AT'];
         $palabrasclave = $_POST['Documento']['PALABRASCLAVE'];
         //$archivo = $_FILES["CONTENIDO"]["tmp_name"]; 
         $tamanio = $_FILES["CONTENIDO"]["size"];
         
         $Documento = new Documento(Input::post('Documento'));
         $Documento->initialize();
         if(!$Documento->save()){
             Flash::error('Falló Operación');
         }else{
}
         }
    }

     public function editardoc()
    {
         View::content('editardoc');
    }
    /*
     public function editarDoc($id=null)
     {
         $documento= new documento();
         if($id!=null)
         {
             $this->documento=$documento->find((int)$id);
         }
         if($this->has_post('documento')){
             if(!$documento->update($this->post('documento'))){
                 Flash::error('Fallo Operación');
                 $this->documento=  $this->post('documento');
             }else{
                 Router::route_to('action: index');
             }
         }
     }*/
}
