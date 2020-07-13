<?php
    defined('BASEPATH') OR exit('URL inválida.');

    //echo '<pre>';
   // print_r($tipo_trabalhos) ;  veio do controllers $tipo_trabalhos
    //echo '</pre>';

    $values = false;
    if ($this->input->server('REQUEST_METHOD')  ==  'POST') 
    $values = true // sendo referenciada dentro de inputs do form

?>

<script src="https://www.google.com/recaptcha/api.js"></script>


<div class="container mt-5 mb-5 card">


    <!-- <a href="<?php // echo site_url('encomendas/testar_email') ?>">Enviar teste email</a> -->
    
    <h2 class="mt-3">ENCOMENDAR</h2>
    <hr>

    <!-- formulário de encomenda-->
    <form action="<?php echo site_url('encomendas/processar_encomenda') ?>" method="post" enctype="multipart/form-data">

        <!-- nome required -->
        <div class="form-group">
             <input type="text" 
                    name="text_nome" 
                    class="form-control" 
                    placeholder="Nome" 
                    maxlength="50"
                    required
                    pattern=".{5,50}"
                    title="Entre 5 e 50 caracteres."
                    value="<?php echo $values ? $inputs['nome'] : '' ?>">  <!-- $values apresentando valores anteriores -->
        </div>

        <!-- morada -->
        <div class="form-group">
             <input type="text" 
                    name="text_morada" 
                    class="form-control" 
                    placeholder="Morada" 
                    maxlength="100"
                    required
                    pattern=".{5,100}"
                    title="Entre 5 e 100 caracteres."
                    value="<?php echo $values ? $inputs['morada'] : '' ?>"> <!-- $values apresentando valores anteriores -->
        </div>

        <!-- codigo_postal == pattern="[0-9] {5} [\ -]? [0-9] {3}" -->
        <div class="form-group">
             <input type="text" 
                    name="text_codigo_postal" 
                    class="form-control" 
                    placeholder="Código postal" 
                    maxlength="8"
                    required                    
                    pattern="\d{4}-\d{3}"
                    title="Escreva o código no formato postal xxxx-xxx"
                    value="<?php echo $values ? $inputs['codigo_postal'] : '' ?>"> <!-- $values apresentando valores anteriores -->
        </div>

        <!-- localidade   -->
        <div class="form-group">
             <input type="text" 
                    name="text_localidade" 
                    class="form-control" 
                    placeholder="Localidade" 
                    required
                    maxlength="50"
                    required                    
                    pattern=".{5,50}"
                    title="Entre 5 e 50 caracteres"
                    value="<?php echo $values ? $inputs['localidade'] : '' ?>"> <!-- $values apresentando valores anteriores -->
        </div>

        <!-- telefone facultativo -->
        <div class="form-group">
             <input type="text" 
                    name="text_telefone" 
                    class="form-control" 
                    placeholder="Telefone"
                    maxlength="9"
                    pattern="[0-9]{9}"
                    title="Com 9 algarismos" 
                    value="<?php echo $values ? $inputs['telefone'] : '' ?>"> <!-- $values apresentando valores anteriores -->
        </div>

        <!-- email -->
        <div class="form-group">
             <input type="email" 
                    name="text_email" 
                    class="form-control" 
                    placeholder="Email"
                    required
                    maxlength="50"
                    pattern=".{5,50}"
                    itle="Entre 5 e 50 caracteres"
                    value="<?php echo $values ? $inputs['email'] : '' ?>"> <!-- $values apresentando valores anteriores -->
        </div>

        <hr>

        <!-- tipo_trabalho -->
        <h3>Tipo de Trabalho</h3>
        <div class="form-group">
             <select name="combo_tipo_trabalho" 
                     class="form-control"
                     id="combo_tipo_trabalho"
                     onchange="detalhes_trabalho()">
                 <option value="0" disable selected>Tipo de trabalho</option>
                 <?php foreach($tipo_trabalhos as $trabalho): ?>
                     <option value="<?php echo $trabalho['id_trabalho']?>"><?php echo $trabalho['designacao']?></option>
                 <?php endforeach; ?>
             </select>
        </div>

        <!-- num rostos no caso do trabalho 3+ rostos -->
        <input type="hidden" name="num_rostos" id="num-rostos" value = "3">

        <!-- espaço de detalhes -->
        <div id="detalhes-trabalho" style="display: none">  <!-- Iniciando oculto -->
            <div class = "card p-3 mt-2 mb-2 bg-light">
                <b>Sumário: </b> <span id="info-sumario"></span><br>
                <b>Preços: </b> <span id="info-precos"></span><br>
                <!-- Botões 3 ou mais rostos-->
                <div id="botoes-3-rostos" style ="display: none">
                    <button type="button" onclick="btn_rostos_click(3)">3 rostos</button>
                    <button type="button" onclick="btn_rostos_click(4)">4 rostos</button>
                    <button type="button" onclick="btn_rostos_click(5)">5 rostos</button>
                </div>
                <h4><b>TOTAL: </b> <span id="info-total"></span><br> </h4>
            </div>
        </div>        

        <!-- observações -->
        <div class="form-group">
             <textarea name="text_observacoes" 
                       rows="5" class="form-control" 
                       placeholder="Observações"
                       maxlength = "2000"><?php echo $values ? $inputs['observacoes'] : '' ?> 
            </textarea>
        </div>

        <hr>
        <!-- fotografias-->
        <h3>Fotografias</h3>
        <div class="form-group">
            <input type="file" name="foto_1" class="form-control mt-4" accept=".jpg" required>
            <input type="file" name="foto_2" class="form-control mt-4" accept=".jpg" >
            <input type="file" name="foto_3" class="form-control mt-4" accept=".jpg" > 
            <input type="file" name="foto_4" class="form-control mt-4" accept=".jpg" >
            <input type="file" name="foto_5" class="form-control mt-4" accept=".jpg" >
        </div>

        <hr>

            <div class="card bg-light mt-3 mb-3 p-4 text-center">iosam enim ratione modi ut! Quas iste quo repellat sunt voluptas omnis 
                veritatis soluta repudiandae fugiat? Cupiditate ex veniam molestias sequi nam exercitationem, provident dolore accusamus ratione cumque 
                neque eligendi explicabo odio deleniti. Velit.</div>

        <hr>

        <!-- sistema de recapcha com data-sitekey para teste  -->
        <div class="row mt-4">
            <div class="col-6 text-center">     
                <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                <div class="alert alert-danger" id="recaptcha-erro" style="display: none">Erro no recaptcha.</div> 
        </div>

        <!-- enviar -->
        <div class="col-6 form-group texte-center align-self-center">
                <!-- condições de serviços -->
                <div class="form-group">
                    <input type="checkbox" 
                        name="check_aceitar" 
                        id="check_aceitar"
                        required>
                    <label for="check_aceitar">Li e aceito os <a href="#" data-toggle="modal" data-target="#modal-condicoes"> Termos e Condições do Serviço.</a></label>
                </div>
                <button class="btn btn-secondary btn-lg">Encomendar</button>
            </div>
        </div>

    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-condicoes" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">TERMOS E CONDIÇÕES DO SERVIÇO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <!-- mensagens das condições -->
            <div class="modal-condicoes">  <!-- class no style  -->
                <?php $this->load->view ('encomendas/condicoes_servico') ?>  <!-- view condições de serviço  -->
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<script>

    let dados = null; /// valores foras para serem usados em todas as funções
    let sumario = null;
    let preco_base = null;
    let preco = null;
    let despesa_envio = null;
    let preco_total = null;
    let id_trabalho = null;


    function detalhes_trabalho(){
        // buscar o valor do combo
        let id_trabalho = $("#combo_tipo_trabalho").val(); // utilizando Jquery
      
        //  definir uma path para a função ajax
        let path = '<?php echo site_url("encomendas/ajax_info_trabalho/") ?>' + id_trabalho;  /// chamando no controllers com id

        // ---------------------------------------------------------------------
        // call de ajax atualiza esse trecho específico 
        $.ajax({
            url: path, // chamando o caminho acima 
            type: 'post',
            success: function(result){

                // apresentar resultado alterado para array
                dados = JSON.parse(result);
                sumario = dados['sumario'];
                preco_base = +dados['preco'];
                despesa_envio = +dados['despesa_envio'];
                id_trabalho = +dados['id_trabalho'];

                // coloca o sumario nas informações
                $("#info-sumario").html(sumario); 

                if(id_trabalho != 4) {    
                    // preço direto            
                    preco = preco_base;
                    preco_total = +preco + despesa_envio;
                    // colocar os dados no div para retratos diferentes de 3 rostos                    
                    $("#info-precos").html(preco + "€ <small> (Retrato) </small> + " + despesa_envio + "€<small> (CTT) </small>");
                    $("#info-total").html(preco_total + "€");
                    $("#botoes-3-rostos").hide(); //// escondendo os botões -----------------------------------------------

                    // reset num rostos para 3 mantendo o valor original para envio 
                    $("#num-rostos").val(3); // acionando no campo de hidden 

                } else {
                    // coloca os dados dos retratos 3 ou mais rostos 
                    preco = preco_base*3;
                    preco_total = preco + +despesa_envio;
                    $("#info-precos").html(preco + "€ <small> (10€/rosto) </small> + " + despesa_envio + "€<small> (CTT) </small> <b>3 ROSTOS</b>.");
                    $("#info-total").html(preco_total + "€");
                    $("#botoes-3-rostos").show();   /// mostrando botões ---------------------------------------------  

                    // define no hidden o número de rostos
                    $("#num-rostos").val(3); // acionando no campo de hidden 
                }

                // tornar o div(informação) visível ///-----------------------------------------------
                $("#detalhes-trabalho").show();

            },
            error: function(){
                console.log('Aconteceu um erro de ligação à base de dados.');
            }
        });
    }

        // ---------------------------------------------------------------------
    function btn_rostos_click(num_rostos){ // recebe o valor de btn_rostos_click(?)
        // define o preço do retrato 
        preco = preco_base*num_rostos;
        preco_total = preco + despesa_envio;
        $("#info-precos").html(preco + "€ <small> (10€/rosto) </small> + " + despesa_envio + "€<small> (CTT) </small> <b>" + num_rostos + " ROSTOS</b>.");
        $("#info-total").html(preco_total + "€");
        $("#botoes-3-rostos").show();  /// mostrando botões ---------------------------------------------  

        // define o número de rostos
        $("#num-rostos").val(num_rostos); // acionando no campo de hidden conforme valor clicado! 
    }

        // ---------------------------------------------------------------------
    $("form").on("submit", function(e){  /// verificação do recapctha no envio do formulário 
        if (grecaptcha.getResponse() == "") {
            e.preventDefault();
            $("#recaptcha-erro").show();
            setTimeout(() => {
                $("#recaptcha-erro").fadeOut();
            }, 2000);
        } else { }
    });




</script>




