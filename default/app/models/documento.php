<?php


class Documento extends ActiveRecord {
    
    public function buscar_documentos_en_carpeta($pages,$carpetaid, $ppage = 5) {
               
                return $inner=$this->paginate_by_sql ("SELECT * FROM `documento` WHERE `carpeta_id`="."'".$carpetaid."'", 'per_page: 5', "page: 1");
    }
    
    public function lecturas($pages,$inicio, $fin,$ppage = 5) {
        return $doc=$this->paginate_by_sql("select * from `documento` where `fechapublicacion_at` between"." '".$inicio."'"." and"." '".$fin."'", 'per_page: 5', "page: 1");
    }
}