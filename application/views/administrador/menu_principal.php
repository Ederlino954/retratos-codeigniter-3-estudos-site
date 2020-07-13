<?php
    defined('BASEPATH') OR exit('URL inválida.');

    $estados = array(
        'Em validação', 
        'Validada',
        'Em execução ',
        'Concluída',
        'Enviada', 
        'Terminada ',
        'Cancelada', 
    );


   // print_r($encomendas);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-6"><h3>Gestão de Encomendas</h3></div>
        <div class="col-6 text-right">
            <a href="<?php echo site_url('main') ?>" class="btn btn-secondary btn-size-200">Ver Website</a>
        </div>
    </div>    

    
    <hr>

    <table  class="table table-striped" id="tabela">
        <thead>
            <th></th>
            <th>Código</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Data </th>
            <th>Total</th>
            <th>Estado</th>
            <th>Atualização</th>
        </thead>

        <?php foreach($encomendas as $encomenda): ?>
            <tr>
                <td>
                    <?php 
                        echo '<a href="'.site_url('administrador/ver_encomenda/' . $encomenda['id_encomenda'] ).'" class="btn btn-secondary"><i class="fa fa-pencil"></i></a>';
                    ?>
                </td>
                <td> <?php echo $encomenda['codigo'] ?></td>
                <td> <?php echo $encomenda['nome'] ?></td>
                <td> <?php echo $encomenda['email'] ?></td>
                <td> <?php echo $encomenda['designacao'] ?></td>
                <td> <?php echo $encomenda['criada_em'] ?></td>                
                <td> <?php echo ( sprintf("%01.2f", $encomenda['preco_final'] + $encomenda['despesa_envio_final']) . " €" ) ?></td>
                <td> <?php echo $estados[$encomenda['estado']] ?></td>
                <td> <?php echo $encomenda['data_atualizacao'] ?></td> <!-- Chamando o ALIAS -->
            </tr>
        <?php endforeach; ?>
        
    </table>
<!--  -->
</div>


<script>
    $(document).ready(function(){
        $("#tabela").DataTable();
    });
</script>


