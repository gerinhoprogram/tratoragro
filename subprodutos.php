<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('header.php');?>
    <title>Trator Agro - Home</title>

</head>

<body>
<header>
<?php 
	include ('core/mod_topo/topo.php');
?>
</header>
<main>
    <section>
      <div class = "bloco_l" >
          <div class="cardimg">
            <img class = "imagem" src="core/imagens/Spider2SGS.png" alt="">
          </div>
      </div>
      <div class="bloco_r">
          <div class = "infocard">
                <p>TITULO CATEGORIA</p>
                <h1 class = "tituloproduto">Titulo produto</h1>
                <p class = "descricao">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <button class = "btnorcamento" id= "button"><i class="fas fa-dolly dolly"></i> Solicitar orçamento</button>
                    <form name='form' id='form2' enctype='multipart/form-data' method='post' action='envia_contato.php?pg=<?php echo $pg; ?>'>
                    <h1>Nome produto</h1>
                    <input name="nome" id="nome" type="text" placeholder="Nome:" class="obg" /><br />
                    <input name="telefone" id="telefone" onkeypress='return mascaraTELEFONE(this);' maxlength='15' type="text" placeholder="Telefone:" class="obg"/>
                    <input name="email" id="email" type="text" placeholder="E-mail:" class="obg" /><br>
                    <textarea id = "mensagem"  rows="10" cols="40" maxlength="500" placeholder="Mensagem: "></textarea>
                    <p><button class="botaoform" id = "botaoform">ENVIAR</button></p>
                    <br>
                </form>
                <script>
            var btn = document.getElementById('button');
            var form = document.getElementById('form2');

btn.addEventListener('click', function() {
  if(form.style.display != 'block') {
    form.style.display = 'block';
    return;
  }
  form.style.display = 'none';
});

                </script>
            </div>
      </div>
    </section>   
    <br> 
    <div class = maps>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.0032843016206!2d-46.213174585893746!3d-23.532384284697248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce77e05cbd4f07%3A0x6a1b2a8fa4fff5ff!2sRua%20Vereador%20Dr.%20Fernando%20de%20Oliveira%20Guena%2C%2090%20-%20Vila%20Lavinia%2C%20Mogi%20das%20Cruzes%20-%20SP%2C%2008735-240!5e0!3m2!1spt-BR!2sbr!4v1620658694549!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <div class = "card">
            <div class = "insidecard">
                <p class = "endereco">ENDEREÇO</p>
                
                <p class = "rua">Rua Vereador Dr. Fernando de
                Oliveira Guena, 90 | Vila Celeste
                Mogi das Cruzes | SP | 08735-240
                </p>
            </div>
        </div>    

    </div>
</main>
    
   <section>
        <footer>
            <?php include('core/mod_rodape/rodape.php');?>
        </footer>
    </section>
       
</body>
</html>
