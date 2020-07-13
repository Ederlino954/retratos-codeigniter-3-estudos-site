<?php
    defined('BASEPATH') OR exit('URL inválida.');
?>
    <!-- exemplos de trabalhos -->
    <div class="row">
        <div class="col-3 text-left"><img src="<?php echo base_url('assets/img/img_retrato_01.jpg') ?>" class="img-fluid img-thumbnail"></div>
        <div class="col-3 text-center"><img src="<?php echo base_url('assets/img/img_retrato_02.jpg') ?>" class="img-fluid img-thumbnail"></div>
        <div class="col-6 text-right"><img src="<?php echo base_url('assets/img/img_retrato_03.jpg') ?>" class="img-fluid img-thumbnail"></div>
    </div>

    <!-- texto 1 -->
    <div class="row mt-3 mb-3 p-5 text-center texto-um">
        Dolore voluptate eiusmod eu ullamco commodo est adipisicing duis dolor cillum Lorem. Proident labore esse mollit ut. Deserunt non nisi dolor laboris incididunt irure.
         Esse aliquip sint adipisicing anim eu occaecat mollit. Laborum in Lorem ipsum ut nisi voluptate laboris. Reprehenderit ea esse ipsum nisi.
    </div>

    <!-- imagem real (lápis a desenhar) e texto 2 + botoes contato e encomendar-->
    <div class="row mb-5">
        <div class="col-4">
            <img src="<?php echo base_url('assets/img/desenho_lapis.jpg') ?>" class="img-fluid">
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12 p-4 text-center texto-dois">cupiditate voluptatibus nulla sint rem. Amet rerum repellendus consequatur saepe delectus minima quam, 
                    consequuntur aliquam quaerat mollitia blanditiis cum, praesentium voluptate illum reprehenderit reiciendis placeat! Incidunt et, nam numquam minima 
                    expedita accusamus quidem repellat similique voluptates.
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-right">
                    <a href="<?php echo site_url("main/contacto") ?>" class="btn btn-secondary btn-size-200 mr-3">Contactar</a>
                </div>
                <div class="col-6 text-left">
                    <a href="<?php echo site_url('encomendas') ?>" class="btn btn-secondary btn-size-200 ml-3">Encomendar</a>
                </div>
            </div>            
        </div>
    </div>




