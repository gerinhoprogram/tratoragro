<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<meta http-equiv="Content-Language" content="pt-br">

<head>
    <?php
        include('header.php');
        $pagina_url = $_GET['p1']; 
        
        $sql = "SELECT * FROM cadastro_categorias
        LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = cadastro_categorias.cat_id
        WHERE cat_url = :cat_url";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':cat_url', $pagina_url);
        $stmt->execute();
        while($result = $stmt->fetch()){
            $categoria_id = $result['cat_id'];
            $titulo = $result['cat_titulo']; 
            echo $categoria_id;
        }
    ?>
        <title>
            Trator Agro - <?php echo $titulo ?>
        </title>
        <style>
            a p{
                color: green
            }
        </style>
</head>

<body>
<header>
    <?php 
        include ('core/mod_topo/topo.php');
    ?>
</header>

    <main>
            <?php 
                $sql_sub_cat = "SELECT * FROM cadastro_subcategorias
                WHERE scat_categoria = $categoria_id
                LIMIT 8";
                $stmt_sub_cat = $PDO->prepare($sql_sub_cat);
                $stmt_sub_cat->execute();
                $rows_sub_cat = $stmt_sub_cat->rowCount();
                if ($rows_sub_cat > 0) {
                    while ($result_sub_cat = $stmt_sub_cat->fetch()) {
                        echo'
                        <a href="produtos/'.$result_sub_cat['scat_url'].'">   
                            <p>'.$result_sub_cat['scat_titulo'].'</p>
                        </a>
                        ';
                    }
                }
            ?>
    
    </main>

    <section>
        <footer>
            <?php include('core/mod_rodape/rodape.php');?>
        </footer>
    </section>
   

</body>

</html>
