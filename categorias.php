<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
        
        include('header.php');
        $pagina_url = $_GET['p1'];
        $pagina_url_2 = $_GET['p2']; 
        $pagina = 'categorias';
        function truncate( $string, $length, $truncateAfter = TRUE, $truncateString = '...' ) {
            if( strlen( $string ) <= $length ) {
                return $string;
            }
            $position = ( $truncateAfter == TRUE ? strrpos( substr( $string, 0, $length ), ' ' ) :strpos( substr( $string, $length ), ' ' ) + $length );
            return substr( $string, 0, $position ) . $truncateString;
        }
    
        
        // CATEGORIA PRINCIPAL
        $sql = "SELECT * FROM cadastro_categorias
        LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = cadastro_categorias.cat_id
        WHERE cat_url = :cat_url";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':cat_url', $pagina_url);
        $stmt->execute();

        while($result = $stmt->fetch()){
            $categoria_id = $result['cat_id'];
            $cat_url = $result['cat_url'];
            $subcategoria_id = $result['scat_id'];
            $titulo = $result['cat_titulo'];
            $imagem = $result['cat_imagem']; 
        }
        // FIM CATEGORIA PRINCIPAL

        if(!empty($pagina_url_2)){
            $sql = "SELECT * FROM cadastro_subcategorias
            WHERE scat_url = :scat_url and scat_categoria = $categoria_id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':scat_url', $pagina_url_2);
            $stmt->execute();

            while($result = $stmt->fetch()){
                $subcategoria_id_2 = $result['scat_id'];
                $subcategoria = $result['scat_categoria'];
                $titulo_subcategoria = $result['scat_titulo'];
                $url_sub = $result['scat_url'];
            }

        }
    ?>
        <title>Trator Agro -
            <?php echo $titulo ?>
        </title>

        <script>
            $(document).ready(function() {
                var num = $('#container-produtos').offset();
                var top = num.top;
                // alert(top);
                $('html, body').animate({
                    scrollTop: top
                }, 900);
            });
        </script>

        <style>
            .section-categotias {
                background-color: #f5f5f5;
                padding-top: 50px;
                padding-bottom: 70px;
                margin-bottom: 0px
            }
            
            .cat-fale {
                padding: 8px;
                border: 1px solid #cccc;
                width: 240px;
                text-align: center;
                margin: 0 auto
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
        <section class="section-categotias">

            <div class="linha categorias" id="categorias">
                <div class="colunas lg-12 md-12 pq-12 cabecalho">
                    <h1>
                        <a href="index" target="_parent" title="Volta para Home"><i class="fa fa-home" aria-hidden="true"></i></a>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>

                        <?php echo "<a href='categorias/".$cat_url."'>" . $titulo . "</a>" . ($titulo_subcategoria != '' ? ' <i class="fa fa-chevron-right" aria-hidden="true"></i> '.$titulo_subcategoria : '') ?>
                    </h1>
                    <p class="txt-explicativo">
                        No lado esquerdo você poderá selecionar a categoria que deseja vizualizar, para obter mais informações do produto, basta clicar no produto que desejar.
                        <a href="faleconosco" target="_parent" title="Fale conosco">
                            <div class="cat-fale"><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Fale conosco</div>
                        </a>
                    </p>
                </div>

                <!-- NAV LADO ESQUERDO COM AS SUBCATEGORIAS -->
                <div class="colunas lg-3 md-4" style="float: left; margin-bottom: 15px;">
                    <div class="nav-categoria" style="height: 645px">
                        <?php 
                                    $sql_sub_cat = "SELECT * FROM cadastro_subcategorias
                                    WHERE scat_categoria = $categoria_id and scat_status = 1
                                    order by scat_destaque ";
                                    $stmt_sub_cat = $PDO->prepare($sql_sub_cat);
                                    $stmt_sub_cat->execute();
                                    $rows_sub_cat = $stmt_sub_cat->rowCount();
                                    if ($rows_sub_cat > 0) {
                                        $cont=1;
                                        while ($result_sub_cat = $stmt_sub_cat->fetch()) {
                                            ?>

                                            <script>
                                                $(document).ready(function() {
                                                    var url = location.href;

                                                    if (url.indexOf("<?php echo $result_sub_cat['scat_url'] ?>") != -1) {
                                                        $('.nav-<?php echo $cont ?>').css("color", "#fff");
                                                        $('.nav-<?php echo $cont ?>').css("font-weight", "bold");
                                                        $('.nav-<?php echo $cont ?>').css("background", "#95ba8f");
                                                    }
                                                });
                                            </script>

                                            <?php
                                            echo'
                                            <a href="categorias/'.$cat_url.'/'.$result_sub_cat['scat_url'].'" id="btn-orca" title="'.$result_sub_cat['scat_titulo'].'" target="_parent">
                                                <div class="nav-categorias nav-'.$cont.'">'
                                                    .$result_sub_cat['scat_titulo'].' <i class="fas fa-chevron-right"></i>
                                                </div>
                                            </a>
                                            ';
                                            $cont++;
                                        }
                                    }
                    ?>
                    </div>

                    <div class="imagem-banner">
                        <img src="webapp/uploads/categorias/<?php echo $imagem ?>" alt="<?php echo $titulo ?>" title="<?php echo $titulo ?>">
                    </div>

                </div>
                <!-- FIM NAV SUBCATEGORIAS -->


                <?php 
                    // PRODUTOS EM DESTAQUE DA CATEGORIA PRINCIPAL ESCOLHIDA -->
                    if(empty($pagina_url_2)){
                                $sql_produto = "SELECT * FROM cadastro_produtos
                                LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
                                LEFT JOIN cadastro_categorias ON cadastro_categorias .cat_id = aux_categoria_produtos.cp_categoria
                                LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = aux_categoria_produtos.cp_subcategoria

                                left join cadastro_produtos_fotos on cadastro_produtos_fotos.foto_produto_id = cadastro_produtos.prod_id
                                where cp_categoria = $categoria_id and prod_destaque = 1 and prod_status = 1 and scat_status = 1
                                group by prod_id
                                order by prod_titulo";
                                $stmt_produto = $PDO->prepare($sql_produto);
                                $stmt_produto->execute();
                                $rows_produto = $stmt_produto->rowCount();
                                if ($rows_produto > 0) {
                                    while ($result_produto = $stmt_produto->fetch()) {
                                        echo'
                                        <div class="colunas lg-3 md-4" style="float: left" id="container-produtos">
                                            <a href="produtos/'.$cat_url.'/'.$result_produto['scat_url'].'/'.$result_produto['prod_url'].'">
                                                <div class="bloco-produtos">
                                                        <span  class="id_prod">ID: '.$result_produto['prod_id'].' | '. truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['cat_titulo']))))), 14).' | '. truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['scat_titulo']))))), 15).'</span>
                                                        '.($result_produto['prod_destaque'] == 1 ? '<span class="destaque">Destaque</span>' : '').'
                                                        <img src="webapp/uploads/produtos/'.$result_produto['foto_nome'].'" alt="'.$result_produto['prod_titulo'].'" title="'.$result_produto['prod_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'"<?php echo'>
                                                        <p  class="legenda">'.     
                                                        truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['prod_titulo']))))), 50) . '</p>
                                                </div>
                                            </a>
                                        </div>
                                        ';
                                    }
                                }else{
                                    echo"<p>Nenhum produto cadastrado nessa categoria.</p>";
                                }
                        // FIM DE PRODUTOS EM DESTAQUE DA CATEGORIA PRINCIPAL ESCOLHIDA washington_fragoso -->
                            }else{
                        // PRODUTOS DA SUBCATEGORIA ESCOLHIDA DO LADO ESQUERDO -->
                                $sql_produto = "SELECT * FROM cadastro_produtos
                                left join cadastro_produtos_fotos on cadastro_produtos_fotos.foto_produto_id = cadastro_produtos.prod_id
                                LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
                                LEFT JOIN cadastro_categorias ON cadastro_categorias .cat_id = aux_categoria_produtos.cp_categoria
                                LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = aux_categoria_produtos.cp_subcategoria
                                where cp_subcategoria = $subcategoria_id_2 and prod_status = 1 and cp_categoria = $categoria_id
                                group by prod_id
                                order by prod_destaque";
                                $stmt_produto = $PDO->prepare($sql_produto);
                                $stmt_produto->execute();
                                $rows_produto = $stmt_produto->rowCount();
                                if ($rows_produto > 0) {
                                    while ($result_produto = $stmt_produto->fetch()) {
                                        echo'
                                        
                                        <div class="colunas lg-3 md-4" style="float: left" id="container-produtos">
                                            <a href="produtos/'.$cat_url.'/'.$url_sub.'/'.$result_produto['prod_url'].'">
                                                <div class="bloco-produtos">
                                                <span class="id_prod">ID: '.$result_produto['prod_id'].' | '.truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['cat_titulo']))))), 14).' | '.truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['scat_titulo']))))), 15).'</span>
                                                '.($result_produto['prod_destaque'] == 1 ? '<span class="destaque">Destaque</span>' : '').'
                                                        <img src="webapp/uploads/produtos/'.$result_produto['foto_nome'].'" alt="'.$result_produto['prod_titulo'].'" title="'.$result_produto['prod_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'"<?php echo'>
                                                <p  class="legenda">'.truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result_produto['prod_titulo']))))), 50).'</p>     
                                                </div>
                                                
                                            </a>
                                    </div>
                                        ';
                                    }
                                }else{
                                    echo"<p>Nenhum produto cadastrado nessa categoria.</p>";
                                }
                            }
                         // FIM DE PRODUTOS DA SUBCATEGORIA ESCOLHIDA DO LADO ESQUERDO -->
                ?>

        </section>
        <?php include('marcas.php');?>
    </main>

    <section>
        <footer>
            <?php include('core/mod_rodape/rodape.php');?>
        </footer>
    </section>

</body>

</html>