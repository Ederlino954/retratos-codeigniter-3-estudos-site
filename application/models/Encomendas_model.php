<?php
    defined('BASEPATH') OR exit('URL inválida.');    
    
    class Encomendas_model extends CI_Model{

            //==============================================
            public function todos_os_trabalhos(){
                // retorna  alista de tipos de trabalhos existentes na base de dados
                return $this->db->query("SELECT * FROM trabalhos")->result_array();
            }

            //===============================================
            public function trabalho($id){
                // vai buscar as informações todas de um determinado tipo de trabalho
                return $this->db->query("SELECT * FROM trabalhos WHERE id_trabalho = $id")->result_array()[0];
            }

            //===============================================  
            public function criar_encomenda($fotografias){
                // faz o registro da encomenda

                // número de rostos 
                $obs_rostos = '';
                if ($this->input->post('combo_tipo_trabalho') == 4) {
                    $obs_rostos = '(Retrato com ' . $this->input->post('num_rostos') . ' rostos.)';
                } 

                // preço final 
                $preco_final = 0;
                $despesa_envio_final = 0;
                if ($this->input->post('combo_tipo_trabalho') != 4) {
                    // retratos normais 
                    $results = $this->db->query("SELECT * FROM trabalhos WHERE id_trabalho = " . $this->input->post('combo_tipo_trabalho') )->result_array()[0];      
                    $preco_final  = $results['preco'];
                    $despesa_envio_final = $results['despesa_envio'];
                } else {
                    // retrato com 3 ou mais rostos 
                    $results = $this->db->query("SELECT * FROM trabalhos WHERE id_trabalho = " . $this->input->post('combo_tipo_trabalho') )->result_array()[0];      
                    $preco_final  = $results['preco'] * $this->input->post('num_rostos');
                    $despesa_envio_final = $results['despesa_envio'];
                }            
            
                // ---------------------------
                // preparação dos parâmentros para gravar a encomenda 
                $params = array(
                    $this->criar_codigo_encomenda(), // código aleatório criado nesse mesmo arquivo model 
                    $this->input->post('text_nome'),
                    $this->input->post('test_morada'),
                    $this->input->post('text_codigo_postal'),
                    $this->input->post('text_localidade'),
                    $this->input->post('text_telefone'),
                    $this->input->post('text_email'),
                    $this->input->post('Combo_tipo_trabalho'),
                    
                    $obs_rostos . PHP_EOL . $this->input->post('text_observacoes'), 
                    'N/A',
                    $preco_final,
                    $despesa_envio_final
                );
                $this->db->query("INSERT INTO encomendas (codigo, nome, morada, codigo_postal, localidade, telefone, email, tipo_trabalho, observacoes, codigo_CTT, preco_final, despesa_envio_final, atualizado_em, criada_em ) 
                                   VALUES(?,?,?,?,?,?,?,?,?,?,?,?,now(),now())", $params );
                //----------------------------------------
                // registros das fotografias na base de dados   
                $ultimo_id = $this->db->query("SELECT MAX(id_encomenda) as id_encomenda FROM encomendas ")->result_array()[0]['id_encomenda']; // selecinando o Maior ID                              
                $params =  array();   
                $query = "INSERT INTO fotografias(id_encomenda, nome) VALUES";    // Dinâmicamente 
                
                foreach ($fotografias as $fotografia) {
                    array_push($params, $ultimo_id); 
                    array_push($params, $fotografia);
                    $query .= "(?,?),"; // acrescentando o bloco dinamicamente 
                }
                $query = substr($query, 0, strlen($query)-1); // retirando a última vírgula da query 
                $this->db->query($query, $params);

                //---------------------------------
                $params = array(
                    $ultimo_id, // guardadndo a última fotografia 
                    0,
                    ''//  obs nada 
                );
                $this->db->query("INSERT INTO estados(id_encomenda, estado, observacoes, atualizado_em) VALUES(?,?,?, now())", $params);
              

                // FALTA FAZER 
                // 1 email para o cliente com a aconfirmação da encomenda (e o código)
                // 1 email para mim com a informação de que uma encomenda foi resgistrada 

                echo 'TERMINADO'; // Atualizar local de retorno após inserção no BD
            }
            

            // ---------------------------------------
            public function verificar_login(){
                // Vai solicitar a base de dados a existencia de dados da encomenda 
                $params = array(
                    $this->input->post('text_email'),
                    $this->input->post('text_codigo'),
                );

                $resultados = $this->db->query("
                    SELECT * FROM encomendas WHERE email = ? AND codigo = ?", 
                    $params)->result_array();

                    // verificar se existe a encomenda 
                if (count($resultados) != 0) {
                    // encomenda existe
                    return true;
                } else {
                    // encomenda não existe
                    return false;
                }
            }

            // ====================================================
            public function dados_encomenda(){
                //  vai buscar os dados de uma encomenda apos o login 
                $params = array(
                    $this->input->post('text_email'),
                    $this->input->post('text_codigo'),
                );
                return $this->db->query("SELECT * FROM encomendas WHERE email = ? AND codigo = ?", $params)->result_array()[0];                   
            }

            // ====================================================
            public function ver_estados_encomenda($id_encomenda){
                // carrega todos os estado da encomenda 
                return $this->db->query("SELECT * FROM estados 
                                                  WHERE id_encomenda = $id_encomenda                                                       
                                                  ORDER BY id_estado DESC ")->result_array();                          
            }
            
            // ====================================================
            public function ver_fotos_encomenda($id_encomenda){
                // carrega a lista de fotos relacionadas com a encomenda 
                return $this->db->query("SELECT * FROM fotografias WHERE id_encomenda = $id_encomenda")->result_array();              
            }

















                

        







            // ---------------------------------------
            private function criar_codigo_encomenda(){ // função usada somente dentro desse model 
                // cria o código da encomenda 
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                $final = '';
                for ($i=0; $i < 10 ; $i++) { 
                    $final .= substr($chars, rand(0,strlen($chars)),1);
                }
                return $final; 
            }


 
     }
?>