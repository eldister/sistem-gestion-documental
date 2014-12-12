<?php

Load::model('carpeta');
Load::model('documento');

Config::set('config.application.breadcrumb', true); // Habilitar la miga de pan

class CarpetaController extends AppController {

    function crear($id) {
        $carpe = new Carpeta();
        $this->titulo = "Bienvenidos a Empleados";
        $this->titulo2 = "Estas en: " . $nombrecarpeta = $carpe->url_carpeta_madre($id)->url;
        $this->usuaior = Auth::get('nombre');

        if (Input::hasPost('Carpeta')) {

            $menu = new carpeta(Input::post('Carpeta'));

            $menu->insertar_carpeta($id, $_POST['Carpeta']['nombrecarpeta']);
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
        $documento = new Documento();
        /* $title =$carpe->nombre_carpeta($id);
          $url='urllll';
          Breadcrumb::update('.', $title, $url); */
        $this->inner = $carpe->abrir_carpeta($page, $id);

        $this->innerdoc = $documento->buscar_documentos_en_carpeta($page, $id, $ppage = 5);
    }

    function creardoc($id) {
        $this->titulo = "";
        $this->titulo2 = "";
        $this->usuaior = Auth::get('nombre');

        if (Input::hasPost('oculto')) {
            //$documento = new documento_controller();
            $documento = new Documento();
            $documento->creardoc($id);
        }
    }

    function editardoc($id) {
        $this->titulo = "";
        $this->titulo2 = "";
        $this->usuaior = Auth::get('nombre');
        $empleado = new Documento();
        $this->titulo = "Editar Documento";
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('documento')) {
            if (!$empleado->update(Input::post('documento'))) {
                Flash::error('Falló Operación');
            } else {
                if ($_FILES['archivo']['name'] != NULL) {
                    $filename = $_POST['documento']['almacenamientofisico'];
                    unlink($filename);

                    $archivo = Upload::factory('archivo'); //llamamos a la libreria y le pasamos el nombre del campo file del formulario
                    $archivo->setExtensions(array('zip', 'rar', 'txt', 'dot', 'doc')); //le asignamos las extensiones a permitir
                    $car = new Carpeta();
                    $url = $car->url_carpeta_madre($_POST['documento']['carpeta_id']);
                    // $path = $_SERVER['DOCUMENT_ROOT'] . '/trunk/default/public/juliancho/a1';
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/trunk/default/public/' . $url->url;
                    $archivo->setPath($path);
                    $archivo->save();
                    $almacenamientofisico = $path . "/" . $_FILES['archivo']['name'];
                    $empleado->almacenamientofisico = $almacenamientofisico;
                    $empleado->update();
                }
                Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Router::redirect();
            }
        } else {
            //Aplicando la autocarga de objeto, para comenzar la edición
            $this->documento = $empleado->find((int) $id);
        }
    }

    function borrardoc($id){ 
        $carpe = new Carpeta();
      $this->titulo = " ";
        $this->titulo2 = "Estas en: " . $nombrecarpeta = $carpe->url_carpeta_madre($id)->url;

        $this->usuaior = Auth::get('nombre');

        if (Input::hasPost('oculto')) {
            $this->titulo = "";
            $this->titulo2 = "";
            $this->usuaior = Auth::get('nombre');
            $doc = new Documento();
            $filename = $doc->url_documento($id)->almacenamientofisico;
            unlink($filename);
            Load::model('documento')->delete($id);
        }
    }

    function descargarDocumento($id) {
        $doc = new Documento();
        $this->archivo = $filename = $doc->url_documento($id)->almacenamientofisico;
        $this->nombre=$doc->nombre_documento($id)->nombredocumento;

        //$this->render('descargarDocumento', null);
    }
    
    function moverdocumento($id) {
    $documentoamover=new Documento();
        $this->titulo = "";
        $this->titulo2 =  $documentoamover->url_documento($id)->almacenamientofisico;
        $this->usuaior = Auth::get('nombre');
          if (Input::hasPost('oculto')) {
              $nombredocumento=$documentoamover->nombre_documento($id)->nombredocumento;
              $carpe = new Carpeta();
              $urlorigen=$documentoamover->url_documento($id)->almacenamientofisico;              
              $urlde=$carpe->url_carpeta_madre($_POST['carpeta']['id'])->url;
              $urldestino=$_SERVER['DOCUMENT_ROOT']."/trunk/default/public/".$urlde."/".$nombredocumento;// se hace asi por que en la base de datos no esta guarda la direccion completa
              $documentoamover->moverdocumento($urlorigen,$urldestino);
              $do=$documentoamover->find($id);
              $do->almacenamientofisico=$urldestino;
              $do->carpeta_id=$_POST['carpeta']['id'];
              $do->update();
                            
              
              
          }
        
        
    }

}
