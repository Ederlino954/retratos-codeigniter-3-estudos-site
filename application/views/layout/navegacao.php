<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>

<!-- Logo e navegação -->
<div class="row mb-5">
<!-- logo -->
    <div class="col-4"><img src="<?php echo base_url('assets/img/logo.jpg') ?>" class="img-fluid"></div>
    <div class="col-8 align-self-center">
        <a href="<?php echo site_url('') ?>" class="link_nav ml-3">Início</a>
        <span class="ml-3">|</span>
        <a href="<?php echo site_url('main/galeria') ?>" class="link_nav ml-3">Galeria</a>
        <span class="ml-3">|</span>
        <a href="<?php echo site_url('main/precos') ?>" class="link_nav ml-3">Preços</a>
        <span class="ml-3">|</span>
        <a href="<?php echo site_url('encomendas') ?>" class="link_nav ml-3">Encomendar</a>
        <span class="ml-3">|</span>
        <a href="<?php echo site_url('main/contacto') ?>" class="link_nav ml-3">Contato</a>
        <span class="ml-3">|</span>
        <a href="<?php echo site_url('area_cliente') ?>" class="link_nav_pessoal ml-3">Área pessoal</a>
    </div>
</div>