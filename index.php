
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include('header.php');?>
    <title><?php echo ($sistema['sistema_nome_fantasia'] ? $sistema['sistema_nome_fantasia'] : 'Tratoragro') ?> - Home</title>

</head>

<body>
<header>
<?php 
	include ('core/mod_topo/topo.php');
?>
</header>
 <section>  
        <?php include('carousel.php');?>
</section> 
<main>
    <section>  
    <div class = "bloco_l">
        <div class = "titulo">
            <p>COMO PODEMOS TE AJUDAR?</p>
        </div>
    </div>
    <div class = "bloco_r">
        <div class = "search2">
        <form action="busca" method="POST" style="padding: 0px; margin: 0px; text-align: left; width: 100%">
            <button type="submit" class="searchButton2">
                <i class="fa fa-search"></i>
            </button>
                <input type="search" name="busca" class="searchTerm2" placeholder="Digite aqui sua busca">
        </form>
        </div>
    </div>
    </section>
    <section>
        <div class = "imginfo">
        <?php 
             $sql_box = "SELECT * FROM cadastro_categorias 
             where cat_destaque = 1
             order by cat_titulo
             LIMIT 5";
             $stmt_box = $PDO->prepare($sql_box);
             $stmt_box->execute();
             $rows_box = $stmt_box->rowCount();
             if ($rows_box > 0) {
                 while ($result_box = $stmt_box->fetch()) {
                     echo'
                     
                        <div class=" view view-first primeiro">
                                <img src="webapp/uploads/categorias/'.$result_box['cat_imagem'].'" title="'.$result_box['cat_titulo'].'" alt="'.$result_box['cat_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'" <?php echo' />
                                <div class="mask">
                                    <div class = botaomask>
                                        <a href="categorias/'.$result_box['cat_url'].'" class="info">Veja mais</a>
                                    </div>
                                </div>
                                <div class = "texto">
                                    <a href = "categorias/'.$result_box['cat_url'].'"><p class= "verde txthover">'.$result_box['cat_titulo'].'</p> </a> 
                                </div>
                        </div> 
                       
                     ';
                 }
            }
        ?>
        
        </div>
    </section>    
    <section>
            <?php include('marcas.php'); ?>
    </section>
    <section>
        <div class = imagem>
            <div class = "meio">
                <div class = logotrator>
                    <img src="core/imagens/logo2.png" alt="">
                </div>
                <div class = texto>
                    <h1 class = "titulotrator verde" ><?=$sistema['sistema_nome_fantasia']?></h1>
                    <h4><?=$sistema['sistema_descricao']?></h4>
                    <a href="empresa/"><button class = botaoagro>Veja mais</button></a>
                </div>
            </div>
        </div>
    </section>    

</main>
    
   <section>
        <footer>
            <?php include('core/mod_rodape/rodape.php');?>
        </footer>
    </section>
       
</body>
</html>
