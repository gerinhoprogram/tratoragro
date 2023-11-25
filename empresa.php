<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('header.php');?>
    <title><?=$sistema['sistema_nome_fantasia']?></title>

</head>

<body>
<header>
<?php 
	include ('core/mod_topo/topo.php');
?>
</header>
<main>
    <div class = "bloco_empresa">
        <div class = "info_empresa">
            <h1 class = titulo_empresa>A Empresa</h1>
            <p class = "texto_empresa"><?=$sistema['sistema_descricao']?></p>
            <br>
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
