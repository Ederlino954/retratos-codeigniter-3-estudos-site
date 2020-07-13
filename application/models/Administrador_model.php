<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Administrador_model extends CI_Model{

        // ================================================================================    
        public function ver_login(){
            // verifica se existe login de administrador
            // Vai solicitar a base de dados a existencia de dados da encomenda 
            $params = array(
                $this->input->post('text_email'),
                md5($this->input->post('text_codigo')) //encriptando  
            );

            $resultados = $this->db->query("
                SELECT * FROM admin WHERE username = ? AND passwrd = ?", 
                $params)->result_array();

                // verificar se coincide com os dados so administrador 
            if (count($resultados) != 0) {   
                // criar a sessão do administrador 
                $this->session->set_userdata('admin', true); // session configurado no autoload 
                return true;
            } else {
                // não foi feito login pelo admin
                return false;
            }
        }

        // ================================================================================
        public function todas_encomendas(){
            // vai buscar todas as encomendas 
            $resultados = $this->db->query(// selecionando o estado mais recente 
                "
                    SELECT encomendas.*, MAX(estados.estado) AS estado, MAX(estados.atualizado_em) AS data_atualizacao, trabalhos.designacao
                    FROM encomendas, estados, trabalhos
                    WHERE encomendas.id_encomenda = estados.id_encomenda
                    AND encomendas.tipo_trabalho = trabalhos.id_trabalho
                    GROUP BY encomendas.id_encomenda
                "
            )->result_array();
            return $resultados;
        }

        // -======================================================================
        public function dados_encomenda($id){
            // dados da encomenda e do estado da mesma --estados.observacoes,
            $resultados = $this->db->query(
                "
                    SELECT encomendas.*,                            
                           trabalhos.designacao, trabalhos.sumario
                    FROM encomendas, trabalhos                    
                    WHERE encomendas.id_encomenda = $id
                    AND encomendas.tipo_trabalho = trabalhos.id_trabalho
                    GROUP BY encomendas.id_encomenda
                "
            )->result_array()[0];
            return $resultados;
        }

        // =========================================================================
        public function dados_estado_encomenda($id){
            // vai buscar os últimos dados da última encomenda
            return $this->db->query("SELECT * FROM estados WHERE id_encomenda = $id ORDER BY id_estado DESC LIMIT 1")->result_array()[0];

        }
        
        /// ================================================================================================
        public function dados_encomenda_fotografias($id){
            // dados sobre afotografias de uma encomenda
            return  $this->db->query("SELECT * FROM fotografias WHERE id_encomenda = $id")->result_array();
        }

        public function alterar_precos($id){
            // Altera os preços das encomendas 
            //  preco_final
            // despesa_envio_final
            $params = array(
                $this->input->post('preco_final'),
                $this->input->post('despesa_envio_final'),
                $id
            );
            $this->db->query("UPDATE encomendas SET preco_final = ?, despesa_envio_final = ? WHERE id_encomenda = ?", $params);
        }

        // =====================================================================================================
        public function editar_estado($id){
            // combo_estados | text_observacoes
            $params = array(
                $id,
                $this->input->post('combo_estados'),
                $this->input->post('text_observacoes')
            );
            $this->db->query("INSERT INTO estados(id_encomenda, estado, observacoes) VALUES(?,?,?)", $params);

        }

        // ======================================================================================================
        public function atualizar_codigo_ctt($id){
            // atualização do código dos CTT na base de dados
            $params = array(
                $this->input->post('text_codigo_ctt'),
                $id
            );
            $this->db->query("UPDATE encomendas SET codigo_ctt = ? WHERE id_encomenda = ? ", $params);
        }
    }
?>