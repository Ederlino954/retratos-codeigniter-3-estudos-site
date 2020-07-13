<?php
    defined('BASEPATH') OR exit('URL inválida.');

    // verifica se a mensagem de email foi enviada com sucesso
    $mensagem = '';
    $classe_mensagem = '';
        if (isset($resultado)) {
            if($resultado == false){
                $mensagem = "O seu email não foi enviado.";
                $classe_mensagem = "alert alert-danger";        
        } else {
            $mensagem = "O seu email foi enviado com sucesso.";
            $classe_mensagem = "alert alert-success";
        }
    }
    
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<h2>Contacto</h2>
<hr>

<div class="row mt-5 mb-5">

    <div class="col-8 offset-2 card p-4">
        
        <div class="card bg-light text-center p-3 mb-4">
            <p>Poderá entrar em contato Através do email <a href="retratos@retratosalapis.com">retratos@retratosalapis.com</a>, ou enviando uma mensagem diretamente através do formulário que se segue.  </p>  
        </div>

        <!-- Mensagem de sucesso ou erro -->
        <?php if($mensagem != ''): ?>
            <div class="<?php echo $classe_mensagem ?> text-center p-3 mt-2 mb-2"><?php echo $mensagem ?></div>
        <?php endif; ?>

        <!-- Formulário de contato  -->
        <form action="<?php echo site_url("main/contacto_enviar") ?>" method="post">

            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="text_nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                    <input type="email" name="text_email" class="form-control" required>
                </div>

            <div class="form-group">
                <label>Mensagem:</label>
                <textarea name="text_mensagem" rows="5" class="form-control" required></textarea>
            </div>

            <div>

                <div class="row">
                    <div class="col-8">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                        <div class="alert alert-danger" id="recaptcha-erro" style="display: none">Erro no recaptcha.</div>                     
                    </div>
                    <div class="col-4 text-right">
                        <button class="btn btn-primary btn-size-150">Enviar</button>
                    </div>
                </div>            
            
            </div>
        
        </form> <!-- form final -->

    </div>

</div>

<script>

        /// =====================================================================
        $("form").on("submit", function(e){
            if (grecaptcha.getResponse() == "") {
                e.preventDefault();
                $("#recaptcha-erro").show();
                setTimeout(() => {
                    $("#recaptcha-erro").fadeOut();
                }, 2000);
            } else { }
        });


</script>