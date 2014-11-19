<?php
class Usuario extends ActiveRecord
{
    public function initialize() {		
        $this->validates_date_in("fechanacimiento_at");
        $this->validates_numericality_of("EXTENSION");
        $this->validates_length_of("CONTRASENA", 50, 8);
    }
     public function getUsuarios($page, $ppage = 5) {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
  

}}
