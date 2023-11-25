
<div class="linha" id="form-id">
    <div>
        <div class="colunas lg-12 ">
            <h1 class="txtcontato">Estamos prontos para te atender!</h1>
        </div>
        <div class="colunas lg-6 md-12 pq-12">

            <div class="formulario">
                <p class="tituloform">FAÇA UM ORÇAMENTO!</p>
                <form name='form' id='form' enctype='multipart/form-data' method='post' action='<?php if($pag_produtos == ''){echo "envia_formulario";}else{echo "envia_produto";} ?>'>

                    <!-- PÁGINA PRODUTO LEVAR ID E NOME DO PRODUTO  -->
                    <?php if($pag_produtos) : ?>
                        <input name="prod_id" type="hidden" value="<?php echo $prod_id ?>" readonly />
                        <label class="esquerda" for="produto_interesse">Assunto</label>
                        <input name="produto_interesse" id="nome" type="text" class="obg" value="<?php echo $prod_titulo ?>" readonly /><br />
                    <?php endif ?>

                    <label class="esquerda" for="nome">*Nome</label>
                    <input name="nome" id="nome" type="text" class="obg" maxlength="100" required /><br />
                    <label class="esquerda" for="telefone">*Telefone</label>
                    <input name="telefone" required id="telefone" onkeypress='return mascaraTELEFONE(this);' maxlength='15' type="text" class="obg" />
                    <label class="esquerda" for="email">*Email</label>
                    <input name="email" id="email" type="email" class="obg" maxlength="100" required /><br>
                    <label class="esquerda" for="mensagem">Mensagem</label>
                    <textarea id="mensagem" rows="3" name="mensagem" cols="40" maxlength="500"></textarea>

                    <div class="linha">
                        <div class="colunas lg-6 md-6 pq-12">
                            <label class="esquerda" for="estados" style="margin-top: 20px">Estados</label>
                            <select class="select" id="estados" name="estados" required>
                                    <option value=""></option>
                                </select>
                        </div>
                        <div class="colunas lg-6 md-6 pq-12">
                            <label class="esquerda" for="cidades" style="margin-top: 20px">Cidades</label>
                            <select class="select" id="cidades" name="cidades" required>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="form-produto">
                        <div class="radio">
                            <input type="radio" id="pf" name="tipo" value="Pessoa Física e Produtor Rural" checked>
                            <label for="pf">Pessoa Física e Produtor Rural</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="op" name="tipo" value="Orgão Público">
                            <label for="op">Órgão Público</label>
                        </div>

                        <div class="radio">
                            <input type="radio" id="pj" name="tipo" value="Pessoa Jurídica">
                            <label for="pj">Pessoa Jurídica</label>
                        </div>

                    </div>

                    <!-- PAGINA PRODUTO NÃO APARECER  -->
                    <?php if(!$pag_produtos) : ?>
                    <select class="select" id="select-pj" name="pecas">
                            <option value="">Peças e equipamentos</option>
                            <option value="1">Peças 1</option>
                            <option value="2">Peças 2</option>
                    </select>
                    <?php endif ?>

                    <p><button class="botaoform">ENVIAR</button></p>
                    <br>
                </form>
            </div>

        </div>
        <div class="colunas lg-6 md-12 pq-12">
            <div style="padding: 10px 15px 30px 15px">
                <p class="tituloform">ATENDIMENTO</p>
                <p class="padding">Segunda a Sexta</p>
                <p>08h às 12h00 | 13h às 17h50 </p>

                <?php if($sistema['sistema_telefone_fixo']) : ?>
                    <a  style="color: #585858" href="tel:+55 <?php echo $sistema['sistema_telefone_fixo'];?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Telefone','value':0}); JSleadsAdd(3, 'TELEFONE FALE CONOSCO');"><p><i class="fas fa-phone verde"></i>&nbsp;<?php echo $sistema['sistema_telefone_fixo'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_telefone_segunda_opcao']) : ?>
                    <a  style="color: #585858" href="tel:+55 <?php echo $sistema['sistema_telefone_segunda_opcao'];?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Telefone','value':0}); JSleadsAdd(3, 'TELEFONE FALE CONOSCO');"><p><i class="fas fa-phone verde"></i>&nbsp;<?php echo $sistema['sistema_telefone_segunda_opcao'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_telefone_terceira_opcao']) : ?>
                    <a  style="color: #585858" href="tel:+55 <?php echo $sistema['sistema_telefone_terceira_opcao'];?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Telefone','value':0}); JSleadsAdd(3, 'TELEFONE FALE CONOSCO');"><p><i class="fas fa-phone verde"></i>&nbsp;<?php echo $sistema['sistema_telefone_terceira_opcao'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_telefone_quarta_opcao']) : ?>
                    <a  style="color: #585858" href="tel:+55 <?php echo $sistema['sistema_telefone_quarta_opcao'];?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Telefone','value':0}); JSleadsAdd(3, 'TELEFONE FALE CONOSCO');"><p><i class="fas fa-phone verde"></i>&nbsp;<?php echo $sistema['sistema_telefone_quarta_opcao'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_whatsap']) : ?>
                    <p><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;<?php echo $sistema['sistema_whatsap'] ?></p>
                <?php endif ?>

                <?php if($sistema['sistema_fax']) : ?>
                    <a  style="color: #585858" href="tel:+55 <?php echo $sistema['sistema_fax']; ?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Telefone','value':0}); JSleadsAdd(3, 'TELEFONE FALE CONOSCO');"><p><i class="fa fa-fax" aria-hidden="true"></i>&nbsp;<?php echo $sistema['sistema_fax'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_email']) : ?>
                    <a  style="color: #585858" href="mailto:<?php echo $sistema['sistema_email'];?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Email','value':0}); JSleadsAdd(4, 'EMAIL FALE CONOSCO');"><p><i class="far fa-envelope verde"></i>&nbsp;<?php echo $sistema['sistema_email'] ?></p></a>
                <?php endif ?>

                <?php if($sistema['sistema_endereco']) : ?>
                    <a  style="color: #585858" href="http://maps.google.com/?q=<?php echo $sistema['sistema_endereco'] .', '. $sistema['sistema_numero'] .', '. $sistema['sistema_cidade'] .', '. $sistema['sistema_estado'] .', '.$sistema['sistema_cep'] ?>" onclick="gtag('event','Click', {'event_category':'Fale Conosco','event_label':'Mapa','value':0});" target='_blank'><p><i class="fas fa-map-marker-alt verde"></i>&nbsp;<?php echo $sistema['sistema_endereco'] .', '. $sistema['sistema_numero'] .'<br>'. $sistema['sistema_cidade'] .' - '.$sistema['sistema_estado'] ?></p></a>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $.getJSON('estados_cidades.json', function(data) {

            var items = [];
            var options = '<option value="">Escolha um estado</option>';

            $.each(data, function(key, val) {
                options += '<option value="' + val.nome + '">' + val.nome + '</option>';
            });
            $("#estados").html(options);

            $("#estados").change(function() {

                var options_cidades = '';
                var str = "";

                $("#estados option:selected").each(function() {
                    str += $(this).text();
                });

                $.each(data, function(key, val) {
                    if (val.nome == str) {
                        $.each(val.cidades, function(key_city, val_city) {
                            options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                        });
                    }
                });

                $("#cidades").html(options_cidades);

            }).change();

        });

    });
</script>