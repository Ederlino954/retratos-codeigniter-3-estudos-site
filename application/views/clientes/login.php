<?php
    defined('BASEPATH') OR exit('URL inválida.');
    //echo $erro;
?>
      <h3>ÁREA DE CLIENTE</h3>

    <hr>

    <div class="row mt-5 mb-5">
        <div class="col-6 offset-3 card p-4">

                <!-- Apresentação do erro  -->
                <?php if(isset($erro)): ?>
                    <div class="alert alert-danger text-center"><?php echo $erro ?></div>           
                <?php endif; ?>

            <!-- Form de login -->
                <form action="<?php echo site_url('area_cliente/ver_login') ?>" method="post">

                    <div class="input-group mt-2 mb-4">                        
                        <input type="email" 
                            name="text_email" 
                            placeholder="Email"
                            class="form-control"
                            required
                            >

                    </div>

                    <div class="input-group mt-4 mb-2">                                
                        <input type="password"
                            name="text_codigo" 
                            id="text-codigo"
                            placeholder="código de encomenda"
                            class="form-control"
                            required>

                            <div class="input-group-append">
                                <span class="input-group-text" id="btn-ver">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>

                            <div class="text-center card bg-light p-3 mt-4">
                                <small>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam dolores adipisci a temporibus eligendi aperiam magni cum cupiditate ad consectetur.
                                </small>
                            </div>
                    </div>

                   

                    <div class="row mt-4">
                        <div class="col-6 text-right">
                            <a href="<?php echo site_url('main') ?>" class="btn btn-secondary btn-lg btn-size-200">Cancelar</a>  <!-- volta para menu inicial -->
                        </div>
                        <div class="col-6 text-left">
                            <button class="btn btn-primary btn-lg btn-size-200">Entrar</button>
                        </div>
                    </div>

                        
                       
                </form>
        
        </div>    
    </div>
    
<script>
    // mecanismo para ver o codigo em texto ou password
    $("#btn-ver").on('click', function(){
        if($("#text-codigo").prop('type') == 'password'){
            $("#text-codigo").attr('type', 'text');
        } else {
            $("#text-codigo").attr('type', 'password');
        }
    });
</script>