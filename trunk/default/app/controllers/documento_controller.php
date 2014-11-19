<?php

class documentoController extends AppController{
     public function editardoc()
    {
        
    }
    public function creardoc()
    {
        
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
