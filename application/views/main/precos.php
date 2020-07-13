<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>

<h3>Preços</h3>
<hr>

<?php foreach($precos as $trabalho): ?>
    <div class="card p-2 mt-2 mb-2">
        <div class="row">
            <div class="col-sm-3 col-xs-12 text-center align-self-center">
                
                <img src="<?php echo base_url('assets/img/tipo_trabalhos/' . $trabalho['id_trabalho']) . '.jpg' ?>" class="img-fluid">                              

            </div>
            <div class="col-sm-9 col-xs-12">
                <h4><?php echo $trabalho['designacao'] ?></h4>
                <hr>
                <p class="sumario-trabalho"><?php echo $trabalho['sumario'] ?></p>
                <div class="row">
                    <div class="col-6">
                        <p class="preco-trabalho"><?php echo $trabalho['preco'] ?>€</p>
                    </div>
                    <div class="col-6 text-right align-self-end">
                        <p class="preco-envio">Envio CTT: <b> <?php echo $trabalho['despesa_envio'] ?>€</b> </p>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>
    
<?php endforeach; ?>

