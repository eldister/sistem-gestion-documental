<?php

Load::model('documento2');

class Documento2Controller extends ApplicationController {

    /**
     * Accion para subir documento
     *
     */
    public function subir() {
        if (Input::hasPost('oculto')) {  //para saber si se envió el form
            $archivo = Upload::factory('archivo'); //llamamos a la libreria y le pasamos el nombre del campo file del formulario

            $archivo->setExtensions(array('zip', 'rar', 'txt', 'dot', 'doc')); //le asignamos las extensiones a permitir
            // Ruta donde se guardara el archivo

            if ($archivo->isUploaded()) {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/trunk/default/public';

                $archivo->setPath($path);
                if ($archivo->save()) {
                    Flash::valid('Archivo subido correctamente...!!!');
                }
            } else {
                Flash::warning('No se ha Podido Subir el Archivo...!!!');
            }
        }
    }

}
