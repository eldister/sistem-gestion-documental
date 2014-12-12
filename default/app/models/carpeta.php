<?php

class Carpeta extends ActiveRecord {
   
    public function initialize() {
		$this->has_many('carpeta'); // una carpera pertenece
             
                 
	}
    public function buscarcarpeta() {// busca las capetas de un usuario
		
                $id2 = Auth::get('id');// este metodo me permite obtener algun dato de la tabla usuario como el nombre o cualquier otro campo
                return  $this->find_all_by_sql ("SELECT * FROM `carpeta` WHERE `usuario_id`="."'".$id2."'");
                 
	}
        
          public function getcarpetas_de_usuarios($pages, $ppage = 5) {
                $id2 = Auth::get('id');// este metodo me permite obtener algun dato de la tabla usuario como el nombre o cualquier otro campo
                $nombreusuario=  Auth::get('nombreusuario');
               // return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta`", 'per_page: 5', "page: 1");
    
                return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta` WHERE `usuario_id`="."'".$id2."'"."and nombrecarpeta='".$nombreusuario."'", 'per_page: 5', "page: 1");
                
                } 
                public function getcarpetasdeusuarios() {
                $id2 = Auth::get('id');// este metodo me permite obtener algun dato de la tabla usuario como el nombre o cualquier otro campo
                $nombreusuario=  Auth::get('nombreusuario');
               // return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta`", 'per_page: 5', "page: 1");
    
                return $this->find_all_by_sql ("SELECT * FROM `carpeta` WHERE `usuario_id`="."'".$id2."'");
                
                } 
        public function abrir_carpeta($pages,$carpetaid, $ppage = 5) {
               
                return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta` WHERE `carpeta_id`="."'".$carpetaid."'", 'per_page: 5', "page: 1");
    }
     public function insertar_carpeta($carpetaid_contenedor,$nombrecarpe) {
         $folder=Load::model('carpeta');
         $folderurl=Load::model('carpeta');
          // $folderurl-> find_by_sql ( "SELECT `url` FROM `carpeta` WHERE `id`="."'".$carpetaid_contenedor."'");
         $urlcontenedora=$folderurl->find_by_sql ( "SELECT `url` FROM `carpeta` WHERE `id`="."'".$carpetaid_contenedor."'");
         
         $folder->nombrecarpeta=$nombrecarpe;
          $url= $urlcontenedora->url.'/'.$nombrecarpe;     
         if($carpetaid_contenedor!=NULL) {$folder->carpeta_id=$carpetaid_contenedor;}
         $folder->usuario_id= Auth::get('id');
         $folder->url=$url;
         $folder->save();
         
         
         
          if (!file_exists($nombrecarpe)) {
                    if (!mkdir($url, 0777, true)) {
                        die('Fallo al crear las carpetas...');
                    }
                    else{
                        return Router::redirect();
                    }
                }
         
     }
     public function insertar_carpeta_editar($carpetaid_contenedor,$nombrecarpe) {
         $folder=Load::model('carpeta');
         $folderurl=Load::model('carpeta');
          // $folderurl-> find_by_sql ( "SELECT `url` FROM `carpeta` WHERE `id`="."'".$carpetaid_contenedor."'");
         //$urlcontenedora=$folderurl->find_by_sql ( "SELECT `url` FROM `carpeta` WHERE `id`="."'".$carpetaid_contenedor."'");
         
         $folder->nombrecarpeta=$nombrecarpe;
          $url= $nombrecarpe;     
         if($carpetaid_contenedor!=NULL) {$folder->carpeta_id=$carpetaid_contenedor;}
         $folder->usuario_id= Auth::get('id');
         $folder->url=$url;
         $folder->save();
         
         
          if (!file_exists($nombrecarpe)) {
                    if (!mkdir($url, 0777, true)) {
                        die('Fallo al crear las carpetas...');
                    }
                }
         
     }
     
     public function nombre_carpeta($id) {
          $folderurl=Load::model('carpeta');
          $folderurl->find_by_sql ( "SELECT `nombrecarpeta` FROM `carpeta` WHERE `id`="."'".$id."'");
          return $folderurl->nombrecarpeta;
        
         
     }
     public function id_carpeta_madre($id) {
          $folderurl=Load::model('carpeta');
          $folderurl->find_by_sql ( "SELECT `id` FROM `carpeta` WHERE `id`="."'".$id."'");
          return $folderurl->nombrecarpeta;
        
         
     }
      public function url_carpeta_madre($id) {
          $folderurl=Load::model('carpeta');
          $folderurl->find_by_sql ( "SELECT `url` FROM `carpeta` WHERE `id`="."'".$id."'");
         
          return $folderurl;
          
        
         
     }
}
