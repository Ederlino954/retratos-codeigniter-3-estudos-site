<?php
    defined('BASEPATH') OR exit('URL inválida.');    
    class Galeria_model extends CI_Model{
        public function imagens(){

            $imagens = array(
                'imagem1',
                'imagem2',
                'imagem3',
                'imagem4',
                'imagem5',
                'imagem6',
                'imagem7',
                'imagem8',
                'imagem9',
                'imagem10',
            );

            return $imagens;

        }
    }
?>