<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Area_cliente extends CI_Controller{ // controllers irá chamar no model e model comunica com banco de dados 
    
        // ==========================================
        public function index($dados = null){
            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');
            // apresenta o quadro de login de cliente / administrador
            $this->load->view('clientes/login', $dados);
            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');

        }

        // ==========================================
        public function ver_login(){

            //---------------------------------------------------------------------------------------------------------------------------------------------
            // verifica se os dados são de login do administrador
            $this->load->model('administrador_model', 'admin'); 
            $resultado = $this->admin->ver_login();
            if ($resultado) {

                // o administrador fez login carrega está parte 
                $this->load->view('layout/inicio');
                $this->load->view('administrador/entrada');
                $this->load->view('layout/fim');
                
                return; // evitando a execução do restante
            }

            // -----------------------------------------------------------------------------------------------------------------------------------------------
            // tratamento da submissão do formulário de login cliente
            $this->load->model('encomendas_model', 'encomendas');
            $resultado = $this->encomendas->verificar_login();

            // verificar o resultado 
            if (!$resultado) {
                $dados['erro'] = "Encomenda inexistente.";
                $this->index($dados); // caso erro ele vai pegar a variável 
                return; // evitando a execução do restante do código em caso de erro 
            }

             // existe encomenda (Apresentar os dados ao cliente )
            $dados['encomenda'] = $this->encomendas->dados_encomenda();
            $dados['fotografias'] = $this->encomendas->ver_fotos_encomenda($dados['encomenda']['id_encomenda']); 
            $dados['estados'] = $this->encomendas->ver_estados_encomenda($dados['encomenda']['id_encomenda']);  
            $dados['tipo_trabalhos'] = $this->encomendas->todos_os_trabalhos();                             

           
            $this->load->view('layout/inicio');
            // apresenta o quadro de login de cliente
            $this->load->view('clientes/ver_encomenda', $dados);
            $this->load->view('layout/fim');

            
        }       
    
    }
?>