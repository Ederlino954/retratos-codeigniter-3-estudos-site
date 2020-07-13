<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    class Administrador extends CI_Controller{     
        
        //---------------------------------------------------------------
            private function ver_sessao(){
            // Apresentar informação de que não pode entrar nessa área
            if (!$this->session->admin) { // se não tiver sessão do ADM
                $this->load->view('layout/inicio_admin');
                $this->load->view('administrador/erro');
                $this->load->view('layout/fim_admin');
                return false;
             }
             return true;
        }
        
         //---------------------------------------------------------------
        public function menu_principal(){ 
            // menu inicial do administrador  
            if (!$this->ver_sessao()) return; // sem sessão do administrador
            
            // carregar as encomendas todas 
            $this->load->model('administrador_model', 'admin');
            $dados['encomendas'] = $this->admin->todas_encomendas();

            $this->load->view('layout/inicio_admin');
            $this->load->view('administrador/menu_principal', $dados);
            $this->load->view('layout/fim_admin');
        }

        // ==================================================================
        public function ver_encomenda($id, $mensagem = ''){
            // ver os dados especificos de uma encomenda 
            
            // carregar os dados da  encomenda selecionada
            $this->load->model('administrador_model','admin');
            $dados['encomenda'] = $this->admin->dados_encomenda($id);
            $dados['estado'] = $this->admin->dados_estado_encomenda($id);
            $dados['fotografias'] = $this->admin->dados_encomenda_fotografias($id);
            $dados['mensagem'] = $mensagem;

            // apresentar os doados da encomenda selecionada
            $this->load->view('layout/inicio_admin');
            $this->load->view('administrador/ver_encomenda', $dados);
            $this->load->view('layout/fim_admin');
        }

        // =====================================================================
        public function alterar_precos($id){
            // Slateração dos preços 
            $this->load->model('administrador_model','admin');
            $this->admin->alterar_precos($id);

            // recarregamento da view
            $this->ver_encomenda($id);
        }

        // =======================================================================
        public function editar_estado($id){
            // procede a atualização do estado da encomenda
            $this->load->model('administrador_model','admin');
            $this->admin->editar_estado($id);

            // recarregamento da view
            $this->ver_encomenda($id);
        }

        // =================================================================

        public function atualizar_codigo_ctt($id){
            // atualiza os códigos dos CTT
            $this->load->model('administrador_model','admin');
            $this->admin->atualizar_codigo_ctt($id);

            // recarregamento da view
            $this->ver_encomenda($id);
        }

        // ====================================================================
        public function enviar_email_codigo_ctt($id){
            // enviar um email para o cliente com o código dos CTT para a sua encomenda 
            $this->load->library('emails');
            $this->load->model('administrador_model', 'administrador');

            $encomenda = $this->administrador->dados_encomenda($id);

            $assunto = 'Retrato á lápis - Envio de encomenda - (Código de CTT)';
            $mensagem = '
                <p>Exmo(a). Sr.(a) <b> '.$encomenda['nome'].'</b>, informo que a encomenda (<b>'.$encomenda['codigo'].'</b>) foi enviada via CTT à cobrança.</p>
                <p> Poderá seguir o caminho da encomenda utilizando o seguinte link: </p>  
                <p><a href="https://www.ctt.pt/feapl_2/app/open/objectSearch/objectSearch.jspx?request_locale=pt">Link para CTT<?/a></p>                       
                <p>Utilize o seguinte código de pesuisa: <b>'.$encomenda['codigo_ctt'].'</b> </p>
                ';
            $destinatario = array($encomenda['email']);

            $resultado = $this->emails->enviar($assunto, $mensagem, $destinatario);

            $mensagem = '';            
            if ($resultado == "email_sucesso") {
                $mensagem = 'email_CTT_sucesso';
            } else {
                $mensagem = 'email_CTT_erro';
            }
            

            // recarregamento da view
            $this->ver_encomenda($id, $mensagem);
        }

        // ===========================================================================
        public function enviar_estado_cliente($id){
            // enviar um email para o cliente com o estado da sua encomenda 
            $this->load->library('emails');
            $this->load->model('administrador_model', 'administrador');
 
            $encomenda = $this->administrador->dados_encomenda($id);
            $estado = $this->administrador->dados_estado_encomenda($id);

            $estados = array(
                'Em validação', 
                'Validada',
                'Em execução ',
                'Concluída',
                'Enviada', 
                'Terminada ',
                'Cancelada', 
            );
 
            $assunto = 'Retrato á lápis - Envio de encomenda - (Código de CTT)';
            $mensagem = '<p>Exmo(a). Sr.(a) <b> '.$encomenda['nome'].'</b>, informo que a encomenda (<b>'.$encomenda['codigo'].'</b>) encontra-se neste momento no seguinte estado:<b>' . $estados[$estado['estado']] . '</b> .</p>';       
            
            if($this->input->post('text_info') != ''){
                $mensagem .= ' <p>Observações:</p><p>  ' . $this->input->post('text_info') . '</p>';
            }

            $destinatario = array($encomenda['email']);
 
            $resultado = $this->emails->enviar($assunto, $mensagem, $destinatario);
 
            $mensagem = '';            
            if ($resultado == "email_sucesso") {
                $mensagem = 'email_estado_sucesso';
            } else {
                $mensagem = 'email_estado_erro';
            }
             
 
             // recarregamento da view
             $this->ver_encomenda($id, $mensagem);

        }
    
    }
?>