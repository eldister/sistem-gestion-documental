<?php

/**
 * Modelo para subir documentos de texto
 *
 */
// Carga la libreria Upload
Load::lib('upload');

class Documento2 {

    /**
     * Guarda el documento
     *
     * @return boolean
     */
    public function guardar() {
        // Instancia con factory un objeto FileUpload
        $file = Upload::factory('doc');
        // Verifica si se subió el documento
        if (!$file->isUploaded()) {
            
            return FALSE;
        }
// Tamaño máximo
        $file->setMaxSize('2MB');

        // Tipos de archivos permitidos
        $file->setTypes(array('text/plain', 'application/vnd.oasis.opendocument.text', 'application/msword'));

        // Extensiones permitidas
        $file->setExtensions(array('txt', 'dot', 'doc'));
         
        // Guarda el archivo
        if ($file->save()) {
           
            Flash::valid('Operación Exitosa');
            return TRUE;
        }
         

        return FALSE;
    }

}
