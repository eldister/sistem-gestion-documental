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
                return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta` WHERE `usuario_id`="."'".$id2."'"."and nombrecarpeta='".$nombreusuario."'", 'per_page: 5', "page: 1");
    }
        public function abrir_carpeta($pages,$carpetaid, $ppage = 5) {
               
                return $inner=$this->paginate_by_sql ("SELECT * FROM `carpeta` WHERE `carpeta_id`="."'".$carpetaid."'", 'per_page: 5', "page: 1");
    }
}