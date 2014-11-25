<?php

class Usuario extends ActiveRecord {

    public function initialize() {
        $this->validates_date_in("fechanacimiento_at");
        $this->validates_numericality_of("EXTENSION");
        $this->validates_length_of("CONTRASENA", 50, 8);
    }

    public function getUsuarios($pages, $valorencombo, $ppage = 5) {

        if ($valorencombo == 0) {
            $consulta = "'registrados'";
        }
        if ($valorencombo == 1) {
            $consulta = "'inactivo'";
        }
        if ($valorencombo == 2) {
            $consulta = "'aceptados'";
        }

      //  $consulta = ".$valorencombo."; // este supuestamente es el valor que me deveria llegar del index mejor dicho el combo pero no se como pasar esa variable hasta aky
       // print_r($consulta);
        return $page = $this->paginate_by_sql("SELECT * FROM `usuario` WHERE `estado`=" . $consulta, 'per_page: 5', "page: 1");
    }

}
