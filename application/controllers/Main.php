<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    
    // ==================================================
    class Main extends CI_Controller{ // main que está sendo chamado em routes // controla os carregamnentos 
    
        Public function index(){
            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');
            $this->load->view('main/inicio');
            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');
        }

        // =======================================================================
        public function galeria(){
            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');

            // carrega todas as imagens da galeria 
            $this->load->model('galeria_model', 'galeria');
            $dados['galeria'] = $this->galeria->imagens();
            $this->load->view('main/galeria', $dados);

            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');
        }

        // ==========================================================================
        public function precos(){
            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');

            // carrega todos os dados dos trabalhos (informações )
            $this->load->model('precos_model', 'precos');
            $dados['precos'] = $this->precos->info();
            $this->load->view('main/precos', $dados);

            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');
        }

        // ==========================================================================
        public function contacto(){
            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');


            $this->load->view('main/contacto');

            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');
        }

        // =========================================================================
        public function contacto_enviar(){

            $this->load->view('layout/inicio');
            $this->load->view('layout/navegacao');

            $resultado = false;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->load->library('emails');
                $nome = $this->input->post("text_nome");
                $email = $this->input->post("text_email");
                $mensagem = $this->input->post("text_mensagem");
                $destinatario = array("ederlinoacamargo05@gmail.com");
                $resultado = $this->emails->enviar("Retratos a lapis - $email ($nome)", $mensagem, $destinatario);
            }

            $dados['resultado'] = $resultado;
 

            $this->load->view('main/contacto', $dados);

            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');        

        }
    
    }
?>