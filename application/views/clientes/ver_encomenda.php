<?php
    defined('BASEPATH') OR exit('URL inválida.');
    
    
    $estados_str = array(
        'Encomenda a aguardar validação',
        'Encomenda validada e pronta para execução.',
        'Trabalho em execução',
        'Encomenda enviada por CTT',
        'Encomenda entregue',
        'Encomenda cancelada', 
    );

?>

<div class="container">

    <h3>DADOS DA ENCOMENDA</h3>

    <hr>

    <h4>DADOS DO CLIENTE</h4>
    <p>CLiente: <?php echo  $encomenda['nome'] ?> </p>
    <p>Morada: <br>
      
    <?php echo $encomenda['morada']. ' - ' . $encomenda['codigo_postal']. ' - ' , $encomenda['localidade'] ?> </p>

    <hr>
    <!-- preco_final despesa_envio_final --->

    <h4>ESTADO DA ENCOMENDA</h4>
    <p>Tipo de retrato: <?php echo $tipo_trabalhos[$encomenda['tipo_trabalho'] - 1 ] ['designacao'] ?></p>
    <p>Sumário: <?php echo $tipo_trabalhos[$encomenda['tipo_trabalho'] - 1 ] ['sumario'] ?></p>
    <p>Preço total: 
    <?php 
        $total = $encomenda['preco_final'] + $encomenda['despesa_envio_final'];
        echo sprintf("%01.2f", $encomenda['preco_final']) . '€ (retrato) + ' . 
             sprintf("%01.2f", $encomenda['despesa_envio_final']) . '€ (CTT) = ' . 
             sprintf("%01.2f", $total) . '€';
    ?>    
    </p>
    <p>Criada em: <?php echo  $encomenda['criada_em'] ?> </p>
    <p>Estado: <?php echo  $estados_str[$estados[0]['estado'] - 1 ] ?> </p>     <!-- erro em estados na apresentação por causa da sequencia do indice // -1 para compensar 0  -->

    <?php if($estados[0]['observacoes'] != ''): ?>
        <p>Observações: <?php echo $estados[0]['observacoes']  ?> </p>
    <?php endif; ?>
    <p><?php echo $estados[0]['atualizado_em']  ?> </p>

    <hr>
    <div class="text_center"> 
        <a href="<?php echo site_url('main') ?>" class="btn btn-primary">Sair</a>   
    </div>

</div>