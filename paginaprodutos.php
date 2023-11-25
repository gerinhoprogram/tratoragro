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
    <section>  
    <div class = "bloco_l">
        <div class = "titulo">
            <p>NO QUE PODEMOS TE AJUDAR?</p>
        </div>
    </div>
    <div class = "bloco_r">
        <div class = "search2">
            <button type="submit" class="searchButton2">
                <i class="fa fa-search"></i>
            </button>
                <input type="search" class="searchTerm2" placeholder="Ou se preferir, procure diretamente aqui">
        </div>
    </div>
    </section>
    <section>
        <div class = "imginfo">
        <?php 
             $sql_box = "SELECT * FROM cadastro_categorias ";
             $stmt_box = $PDO->prepare($sql_box);
             $stmt_box->execute();
             $rows_box = $stmt_box->rowCount();
             if ($rows_box > 0) {
                 while ($result_box = $stmt_box->fetch()) {
                     echo'
                        <div class=" view view-first primeiro">
                                <img src="webapp/'.$result_box['cat_imagem'].'" title="'.$result_box['cat_titulo'].'" alt="'.$result_box['cat_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'" <?php echo' />
                                <div class="mask">
                                    <div class = botaomask>
                                        <a href="categorias/'.$result_box['cat_url'].'" class="info">Veja mais</a>
                                    </div>
                                </div>
                                <div class = "texto">
                                    <p class= "verde txthover">'.$result_box['cat_titulo'].'</p>
                                </div>
                        </div> 
                     ';
                 }
            }
        ?>
        
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
