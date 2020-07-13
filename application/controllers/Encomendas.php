<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Encomendas extends CI_Controller{

        //====================================================    
        public function index($data = null) {
            $this->load->view('layout/inicio');

            // navegação
            $this->load->view('layout/navegacao');

            // vai buscar todos os tipos de trabalhos possíveis
            $this->load->model('encomendas_model' , 'encomendas');  // usando alias mudando para encomendas 
            $data['tipo_trabalhos'] = $this->encomendas->todos_os_trabalhos();
            $this->load->view('encomendas/encomendafrm', $data); // tipo_tarbalhos transfoprmado em array associativo 
            
            $this->load->view('layout/rodape');
            $this->load->view('layout/fim');
        }

        //====================================================
        public function ajax_info_trabalho($id){
            // vai buscar as informações sobre o tipo de trabalho
            $this->load->model('encomendas_model', 'encomendas'); // usando alias mudando para encomendas 
            $resultados = $this->encomendas->trabalho($id);
            echo json_encode($resultados);
        }

        //====================================================
        public function processar_encomenda(){

            $mensagem = '';

            // recolher as informações do input
            $inputs = array(
                'nome'              => $this->input->post('text_nome'),
                'morada'            => $this->input->post('text_morada'),
                'codigo_postal'     => $this->input->post('text_codigo_postal'),
                'localidade'        => $this->input->post('text_localidade'),
                'telefone'          => $this->input->post('text_telefone'),
                'email'             => $this->input->post('text_email'),
                'tipo_trabalho'     => $this->input->post('combo_tipo_trabalho'),
                'numero_rostos'     => $this->input->post('num_rostos'),
                'observacoes'       => $this->input->post('text_observacoes'),
            );

            // pequeno mecanismo de validação do lado do servidor 
            if ($inputs['nome'] == '' ||
                $inputs['morada'] == '' ||
                $inputs['codigo_postal'] == ''  ||
                $inputs['localidade'] == ''  ||
                $inputs['email'] == ''
                ) {
                    $data['inputs'] = $inputs;
                    $data['erro'] = 'Preencha todos os dados obrigatórios';
                    $this->index($data);
                    return;                    
            }         
            
            // tratar as fotografias 
            $fotografias = array();
            foreach ($_FILES as $foto) {
                if ($foto['name'] !== '') {
                    $novo_nome = uniqid() . '_' .$foto['name'];
                    array_push($fotografias, $novo_nome);
                    move_uploaded_file($foto['tmp_name'], 'assets/fotos/' . $novo_nome);
                } 
            }

            // registro da nova encomenda na base de dados 
            $this->load->model('encomendas_model', 'encomendas');
            $this->encomendas->criar_encomenda($fotografias);
        }

        //=====================================
        public function testar_email(){ // serve só para testar  
            $this->load->library('emails');
            $this->emails->enviar('Assunto teste' , 'Mensagem teste', array('ederlinoacamargos05@gamil.com'));
        }



    }
?>