<?php
    defined('BASEPATH') OR exit('URL inválida.');

    //print_r($encomenda); // unidimensioal 
    //print_r($estado); // unidimensioal 
    //print_r($fotografias); // multidimensional
    //exit();

    // calcula o total das despesas do cliente (retrato + CTT)

    $calculo = $encomenda['preco_final'] + $encomenda['despesa_envio_final'];                   
    $preco_total = sprintf("%01.2f", $calculo) . " €";

    // Alterar o formato da data de estado
    $dt = new DateTime($estado['atualizado_em']);
    $estado['atualizado_em'] = $dt->format('d-m-Y H:i:s');

    $estados = array(
        'Em validação', 
        'Validada',
        'Em execução ',
        'Concluída',
        'Enviada', 
        'Terminada ',
        'Cancelada', 
    );
?>

<div class="container">

    <!-- mensagem de sucesso ou erro-->
    <?php if($mensagem != ''): ?>

        <!-- Mensagem -->
        <?php if($mensagem == 'email_CTT_sucesso'): ?>
            <div class="alert alert-success text-center">Email com o código de CTT enviado com sucesso.</div>
        <?php elseif($mensagem == 'email_CTT_erro'): ?>
            <div class="alert alert-danger text-center">Email com o código de CTT não foi enviado.</div>
        <?php elseif($mensagem == 'email_estado_sucesso'): ?>
            <div class="alert alert-success text-center">Email com o estado da encomenda enviado com sucesso.</div>
        <?php elseif($mensagem == 'email_estado_erro'): ?>
            <div class="alert alert-danger text-center">Email com o estado da encomenda não foi enviado.</div>
        <?php endif;?>

    <?php endif;?>

    <div class="row mt-3 mb-3">
        <div class="col-12">
            <a href="<?php echo site_url('administrador/menu_principal') ?>" class="btn btn-primary">Voltar</a>
            <h1>detalhes encomenda </h1>
            <hr>

                <!-- dados gerais da encomenda -->
                <div class="row">
                    <div class="col-6">
                        Código <b><?php echo $encomenda['codigo'] ?></b> 
                    </div>  

                    <div class="col-6 text-right">
                        Criada em: <b><?php echo $encomenda['criada_em'] ?></b>
                    </div>     

                </div>
                <hr>

                <!-- Estado -->
                <div class="card bg-light mt-3 mb-3 p-3">
                    <div class="d-flex flex-row ">
                        <div class="p-2 bd-highlight mr-5">Estado: <b><?php echo $estados[$estado['estado']] ?></b></div>
                        <div class="p-2 bd-highlight mr-5">Atualizado em: <b><?php echo  $estado['atualizado_em'] ?></b></div>
                        <div class="p-2 bd-highlight">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-estado">Editar estado ... </button>
                            <button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target="#modal-enviar_estado">Enviar detalhes ao cliente ... </button>                        
                        </div>                    
                    </div>
                    
                    <!-- observações do estado -->
                    <div>
                        <?php echo $estado['observacoes'] ?>
                    </div>
                </div>

                <!-- ALTERAR O ESTADO DA ENCOMENDA ----------------------------------------------------------------------------------------------------------------->
                <div class="modal fade" id="modal-estado" tabindex="-1" role="dialog" aria-labelledby="Titulo_modal_estado" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-write">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">ESTADO DA ENCOMENDA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="<?php echo site_url('administrador/editar_estado/' . $encomenda['id_encomenda']) ?>" method="post">
                                <div class="modal-body">
                                    <!-- Select dos estados --> 
                                    <div class="form-group">
                                        <label>Estado atual:</label>
                                        <select name="combo_estados" class="form-control">
                                            <?php 
                                                $ne = 0;
                                                foreach ($estados as $est) {
                                                    $estado_string = $estados[$ne];
                                                    if ($ne == $estado['estado'] ) {
                                                        echo "<option value=\"$ne\" selected>$estado_string</option>";
                                                    } else {
                                                        echo "<option value=\"$ne\">$estado_string</option>";
                                                    }                                           
                                                    $ne++;
                                                }                                                                        
                                            ?>
                                            
                                        </select>
                                    </div>

                                    <!-- Campo de texto das observações -->
                                    <div class="form-group">
                                        <label>Observações:</label>
                                        <textarea name="text_observacoes" rows="5" class="form-control"><?php echo $estado['observacoes'] ?></textarea>
                                    </div>                        
                                </div>

                                <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary">Atualizar</button> <!-- botão submetendo  -->
                                </div>
                            </form> <!-- Fim da form -->
                        </div>
                    </div>
                </div>

                <!-- ALTERAR O ESTADO DA ENCOMENDA ---------------------------------------------------------------------------------------------------------------------->
                <div class="modal fade" id="modal-enviar_estado" tabindex="-1" role="dialog" aria-labelledby="titulo_modal_enviar_estado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-write">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">ENVIAR ESTADO DA ENCOMENDA AO CLIENTE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="<?php echo site_url('administrador/enviar_estado_cliente/' . $encomenda['id_encomenda']) ?>" method="post">
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-3 text-right">Código:</div>
                                        <div class="col-9"><b><?php echo $encomenda['codigo'] ?></b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-right">Nome:</div>
                                        <div class="col-9"><b><?php echo $encomenda['nome'] ?></b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-right">Morada:</div>
                                        <div class="col-9"><b><?php echo $encomenda['morada'] . ' - ' . $encomenda['codigo_postal']. ' - ' . $encomenda['localidade'] ?></b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-right">Estado:</div>
                                        <div class="col-9"><b><?php echo $estados[$estado['estado']] ?></b></div>
                                    </div>

                                    <hr>
                                    <p>Observações:</p>
                                    <textarea name="text_info" class="form-control" rows="5"></textarea>
                                                            
                                </div>

                                <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary">Enviar</button>
                                </div>
                            </form> <!-- Fim da form -->
                        </div>
                    </div>
                </div>

                <div class="card bg-light p-3">

                    <p>Nome do cliente <b><?php echo $encomenda['nome'] ?></b> </p>
                    <p>Morada <b><?php echo $encomenda['morada'] ?></b> </p>
                    <p>Código postal <b><?php echo $encomenda['codigo_postal']. " - " . $encomenda['localidade'] ?></b> </p>

                    <p>Telefone <b><?php echo $encomenda['telefone'] ?></b> </p>
                    <p>Email <b><?php echo $encomenda['email'] ?></b> </p>

                    <!-- Dados específicos da encomenda  -->                
                    <hr>
                    <p>
                        Tipo de trabalho: <b><?php echo $encomenda['designacao'] ?></b><br>
                        <small><?php echo $encomenda['sumario'] ?></small>
                    </p>

                    <hr>
                    <!-- Observações do Cliente  -->
                    <div class=" mt-2 mb-4">
                        <h4>Observações:</h4>
                        <?php echo $encomenda['observacoes'] ?>
                    </div>
                </div>

                <!-- Preço do trabalho  -->
                <div class="card bg-light mt-3 mb-3 p-3">
                    <div class="row">
                        <div class="col-4">
                            Preço do retrato: <?php echo sprintf("%01.2f", $encomenda['preco_final']) . " €"  ?>
                        </div>      
                        <div class="col-4">
                            Preço de envio: <?php echo sprintf("%01.2f", $encomenda['despesa_envio_final']) . " €" ?>
                        </div>
                        <div class="col-4">
                            Preço TOTAL: <?php echo $preco_total ?>
                        </div>

                    </div>

                    <div class="mt-2 mb-2">
                    <a data-toggle="collapse" href="#collapseExample" class="btn btn-primary">Editar preços</a>
                    </div>

                    <div class="collapse" id="collapseExample">
                        <divv class="card card-body">
                            <form action="<?php echo site_url('administrador/alterar_precos/' .$encomenda['id_encomenda']) ?>" method="post">
                                Preço trabalho: <input type="number" name="preco_final" id="preco_final" value="<?php echo $encomenda['preco_final'] ?>">
                                Despesa de envio: <input type="number" name="despesa_envio_final" id="despesa_envio_final" value="<?php echo $encomenda['despesa_envio_final'] ?>">
                                <button calss="btn btn-primary">Alterar</button>
                            </form>                    
                        </div>
                </div>

                 <!-- fotografias --> 
                <div class="card bg-light p-3 mt-3 mb-3">

                    <h4>Fotografias:</h4>
                    <hr>

                    <div class="row">
                       <!--<img src="..." alt="..." class="img-thumbnail">-->
                       <?php foreach($fotografias as $fotografia ): ?>

                            <div class="col-3 text-center">
                                <a href="<?php echo  base_url('assets/fotos/'. $fotografia['nome']) ?>" target="_blank" >
                                <img src="<?php echo  base_url('assets/fotos/'. $fotografia['nome']) ?> " class="img-thumbnail" >
                                </a>
                            </div>
                    <?php endforeach; ?>

                    </div>

                </div>

                <!-- código CTT -->
                <div class="card bg-light p-3 mt-3 mb-3">
                    <h4>CÓDIGO DOS CTT</h4>
                    <hr>
                    <form action="<?php echo site_url('administrador/atualizar_codigo_ctt/' . $encomenda['id_encomenda']) ?>" method="post">
                        <div class="d-flex flex-row mb-3">
                            <div class="p-2 form-group"> 
                                <input type="text" class="form-control" name="text_codigo_ctt" placeholder="Código CTT" value="<?php echo $encomenda['codigo_ctt'] == 'N/A' ? '' : $encomenda['codigo_ctt']  ?>">
                            </div>
                            <div class="p-2 ">
                                <button class="btn btn-primary">Gravar</button>
                            </div>

                            <?php if ($encomenda['codigo_ctt'] != '' && $encomenda['codigo_ctt'] != 'N/A'): ?>
                                <div class="p-2 ml-5 ">
                                    <a href="<?php echo site_url('administrador/enviar_email_codigo_ctt/' . $encomenda['id_encomenda']) ?>"  class="btn btn-primary">Enviar o código para o cliente</a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </form>

                    <a href="https://www.ctt.pt/feapl_2/app/open/objectSearch/objectSearch.jspx?request_locale=pt" target="blank">Abrir pesquisa dos CTT</a>                                                             
                </div>

 
            </div>
        </div>
    </div>
</div>



