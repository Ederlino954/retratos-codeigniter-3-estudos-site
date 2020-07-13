<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>

<h3>Galeria</h3>
<hr>

<div class="row">
    <?php foreach($galeria as $imagem): ?>
       <div class="col-3 p-2 align-self-center">
            <a href="<?php echo base_url('assets/img/galeria/'.$imagem.'.jpg') ?>" data-lightbox="galeria">
                <img src="<?php echo base_url('assets/img/galeria/'.$imagem.'.jpg') ?>" class="img-fluid img-thumbnail" >       
            </a>
        </div>
    <?php endforeach; ?>
</div>