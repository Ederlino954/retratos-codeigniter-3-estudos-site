<?php
    defined('BASEPATH') OR exit('URL inválida.');    
    class Precos_model extends CI_Model{
        public function info(){
            // Buscar informação à base de dados sobre os tipos de trabalhos
            return $this->db->query("SELECT * FROM trabalhos ORDER BY id_trabalho")->result_array();

        }
    }
?>