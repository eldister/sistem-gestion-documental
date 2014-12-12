<?php
Load::model('carpeta');
Load::model('documento');

Config::set('config.application.breadcrumb', true); // Habilitar la miga de pan
class CarpetaController extends AppController{
    function crear(){
         
       if(Input::hasPost('Carpeta')){
          
           $menu = new carpeta(Input::post('Carpeta'));
          
           if(!$menu->save()){
               Flash::error('Falló Operación');
           }else{
               Flash::valid('Operación exitosa');
               //Eliminamos el POST, si no queremos que se vean en el form
               Input::delete();
           }
       }     
   }
  

    function index($page = 1) {
        $this->titulo = "Mis Documentos";
        $this->titulo2 = "";
        $this->usuaior = Auth::get('nombre');

        $carpe = new Carpeta();
        $this->inner = $carpe->getcarpetas_de_usuarios($page);
    }

    function abrir($id) {
        $carpe = new Carpeta();
        $this->titulo = " ";
        $this->titulo2 = "Estas en: " . $nombrecarpeta = $carpe->url_carpeta_madre($id)->url;

        $this->usuaior = Auth::get('nombre');
        $carpe = new Carpeta();
        $carpetaid = $_POST["id"];
        $documento=new Documento();
       $this->inner=$carpe->abrir_carpeta($page,$id);
       
        $this->innerdoc=$documento->buscar_documentos_en_carpeta($page,$id);
   }  
}
