<?php
Load::lib('libchart');
Load::model('carpeta');
Load::model('documento');
Config::set('config.application.breadcrumb', true); // Habilitar la miga de pan
class CarpetaController extends AppController{
    function crear()
        {
         
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
   function index($page=1){
       
         //al directorio public hay que darle premisos 777
        $estructura = "prueva";// crea una careta en default puplic
        if (!mkdir($estructura, 0777, true)) {
            die('Fallo al crear las carpetas...');
        }
       $carpe=new Carpeta();
       $this->inner=$carpe->getcarpetas_de_usuarios($page);
   }
   function abrir($id)
   {
       $carpe=new Carpeta();
        $carpetaid = $_POST["id"];
        $documento=new Documento();
       $this->inner=$carpe->abrir_carpeta($page,$id);
       
        $this->innerdoc=$documento->buscar_documentos_en_carpeta($page,$id);
       
   }
   
   function grafica (){
       $chart = new VerticalBarChart(300, 200);
       $dataSet = new XYDataSet();
       $dataSet->addPoint(new Point("Jan 2014", 273));
       $dataSet->addPoint(new Point("Mar 2014", 300));
       $dataSet->addPoint(new Point("Apr 2014", 400));
       $chart->setDataSet($dataSet);
       $chart->setTitle("Prueba");
       $chart->render('public/img/graficas/grafica1.png');
   }   

}