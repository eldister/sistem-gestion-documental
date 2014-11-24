<?php
class Usuario extends ActiveRecord
{
    public function initialize() {		
        $this->validates_date_in("fechanacimiento_at");
        $this->validates_numericality_of("EXTENSION");
        $this->validates_length_of("CONTRASENA", 50, 8);
    }
     public function getUsuarios($pages, $ppage = 5) {
       $usua = new Usuario();
        $consulta = "'inactivo'";
        // $usuario-> find_all_by_sql("SELECT * FROM `usuario` WHERE `estado`='inactivo'" );
        //return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
        return  $page = $this-> paginate_by_sql( "SELECT * FROM `usuario` WHERE `estado`=".$consulta , 'per_page: 5', "page: 1");
  

}}
