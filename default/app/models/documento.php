<?php

Load::lib('upload');
Load::model('carpeta');
class Documento extends ActiveRecord {

    public function buscar_documentos_en_carpeta($pages, $carpetaid, $ppage = 5) {

        return $inner = $this->paginate_by_sql("SELECT * FROM `documento` WHERE `carpeta_id`=" . "'" . $carpetaid . "'", 'per_page: 5', "page: 1");
    }
    
    public function lecturas($pages,$inicio, $fin,$ppage = 5) {
        return $doc=$this->paginate_by_sql("select * from `documento` where `fechapublicacion_at` between"." '".$inicio."'"." and"." '".$fin."'", 'per_page: 5', "page: 1");
    }
    public function creardoc($id) {
        
        $archivo = Upload::factory('archivo'); //llamamos a la libreria y le pasamos el nombre del campo file del formulario

        $archivo->setExtensions(array('zip', 'rar', 'txt', 'odt', 'doc')); //le asignamos las extensiones a permitir
        // Ruta donde se guardara el archivo

        if ($archivo->isUploaded()) {
            
            $car=new Carpeta();
            $url=$car->url_carpeta_madre($id);
           // $path = $_SERVER['DOCUMENT_ROOT'] . '/trunk/default/public/juliancho/a1';
            $path = $_SERVER['DOCUMENT_ROOT'].'/trunk/default/public/'.$url->url;
            

            $archivo->setPath($path);
            
            if ($archivo->save()) {

                 $nombredoc = $_POST['documento']['nombredocumento']; // crea una careta en default puplic
                  $autor = $_POST['documento']['autor'];
                  $fechapublicacion = $_POST['documento']['fechapublicacion'];
                  $descrip= $_POST['documento']['descripcion'];
                  $pclave=$descrip= $_POST['documento']['palabrasclave'];
                  $folio=$_POST['documento']['folio'];
                  $carpeta_id=$id;
                  $usuario_id= Auth::get('id');
                  $almacenamientofisico=$path."/".$_FILES['archivo']['name'];// devuelve el nombre original del archivo
                  
                $doc=Load::model('documento');
                $doc->nombredocumento=$_FILES['archivo']['name'];;                
                $doc->usuario_id=$usuario_id;
                $doc->carpeta_id=$carpeta_id;
                $doc->autor=$autor;
                $doc->descripcion=$descrip;
                $doc->fechapublicacion=$fechapublicacion;
                $doc->palabrasclave=$pclave;
                $doc->folio=$folio;
                $doc->tamano=$_FILES['archivo']['size'];
                $doc->almacenamientofisico=$almacenamientofisico;
                $doc->save();
                Flash::valid('Archivo subido correctamente...!!!');
                Router::route_to('action: index');

                
            }
        } else {
            Flash::warning('No se ha Podido Subir el Archivo...!!!');
        }
    }
    
     public function url_documento($id) {
          $docurl=Load::model('documento');
          $docurl->find_by_sql ( "SELECT `almacenamientofisico` FROM `documento` WHERE `id`="."'".$id."'");
         
          return $docurl;
        
         
     }
      public function nombre_documento($id) {
          $docurl=Load::model('documento');
          $docurl->find_by_sql ( "SELECT `nombredocumento` FROM `documento` WHERE `id`="."'".$id."'");
         
          return $docurl;
        
         
     }
     public function moverdocumento($urlorigen,$urldestino) {
      
        
         rename ($urlorigen,$urldestino);
         
     }

}
