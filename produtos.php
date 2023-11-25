<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
        include('header.php');
        $url_cat = $_GET['p1'];
        $url_sub = $_GET['p2'];
        $url_prod = $_GET['p3'];
        $pag_produtos = false; 
        function truncate( $string, $length, $truncateAfter = TRUE, $truncateString = '...' ) {
            if( strlen( $string ) <= $length ) {
                return $string;
            }
            $position = ( $truncateAfter == TRUE ? strrpos( substr( $string, 0, $length ), ' ' ) :strpos( substr( $string, $length ), ' ' ) + $length );
            return substr( $string, 0, $position ) . $truncateString;
        }
    

            $sql = "SELECT * FROM cadastro_produtos
            LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
            LEFT JOIN cadastro_categorias ON cadastro_categorias.cat_id = aux_categoria_produtos.cp_categoria
            LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = aux_categoria_produtos.cp_subcategoria
            WHERE prod_url = :prod_url and prod_status = 1 and cat_url = :cat_url and scat_url = :scat_url";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':prod_url', $url_prod);
            $stmt->bindParam(':cat_url', $url_cat);
            $stmt->bindParam(':scat_url', $url_sub);
            $stmt->execute();
            while($result = $stmt->fetch()){

                $prod_id = $result['prod_id'];

                $sql_foto = "SELECT * FROM cadastro_produtos_fotos
                WHERE foto_id = :foto_id";
                $stmt_foto = $PDO->prepare($sql_foto);
                $stmt_foto->bindParam(':foto_id', $prod_id);
                $stmt_foto->execute();
                $result_foto = $stmt_foto->fetch();

                $prod_titulo = $result['prod_titulo'];
                $prod_descricao = $result['prod_descricao'];
                $foto_nome = $result_foto['foto_nome'];
                $cat_titulo = $result['cat_titulo'];
                $sub_titulo = $result['scat_titulo'];
                $sub_id = $result['scat_id'];
                $cat_id = $result['cat_id'];
                
                $pag_produtos = true;
            }
       
    ?>
        <title>Trator Agro
            <?php echo ($prod_titulo ? ' - '.$prod_titulo : ' - Categorias' ) ?>
        </title>

        <!-- DESLIZA HTML AO CLICAR EM #BTN-ORCA -->
        <script>
            jQuery(document).ready(function() {
                $('#btn-orca').click(function() {
                    var num = $('#form-id').offset();
                    var top = num.top;
                    $('html, body')
                        .animate({
                            scrollTop: top
                        }, 1500)
                });
            });
        </script>
        <!-- FIM EFEITO -->

</head>

<body>
    <header>
        <?php 
	        include ('core/mod_topo/topo.php');
        ?>
    </header>
    <main>
        <section style="background-color: #f5f5f5; padding-top: 50px; padding-bottom: 70px; margin-bottom: 0px">

            <!-- PÁGINA DO PRODUTO LINKADO -->
            <?php if($pag_produtos) : ?>

            <!-- CABEÇALHO DA PÁGINA -->
            <div class="linha pg-produtos">
                <div class="colunas lg-12 md-12 pq-12">
                    <p>
                        <a href="index" target="_parent" title="Volta para Home"><i class="fa fa-home" aria-hidden="true"></i></a>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="categorias/<?php echo $url_cat ?>" title="Acessar categorias de <?php echo $cat_titulo ?> ">
                            <?php echo $cat_titulo ?>
                        </a>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="categorias/<?php echo $url_cat ?>/<?php echo $url_sub ?>" title="Acessar produtos de <?php echo $sub_titulo ?> ">
                            <?php echo $sub_titulo ?> </a>
                    </p>
                </div>
            </div>
            <!-- FIM CABEÇALHO -->

            <div class="linha">
                <div class="colunas lg-6 md-6 pq-12" style="margin-bottom: 40px">
                    <div class="foto-produto">

                    <!-- FOTO PRINCIPAL -->
                        <?php 
                                $sql_fotos = "SELECT * FROM cadastro_produtos_fotos
                                where foto_produto_id = $prod_id 
                                order by foto_principal";
                                $stmt_fotos = $PDO->prepare($sql_fotos);
                                $stmt_fotos->execute();
                                $rows_fotos = $stmt_fotos->rowCount();
                                if ($rows_fotos > 0) {
                                    while ($result_fotos = $stmt_fotos->fetch()) {
                                        echo'
                                            <a href="webapp/uploads/produtos/'.$result_fotos['foto_nome'].'" rel="shadowbox[fotos]" target="_parent">   
                                                <img class="mySlides fade" src="webapp/uploads/produtos/'.$result_fotos['foto_nome'].'" alt="tratoagro">
                                            </a> ';
                                    }
                                }
                        ?>
                    <!-- FOTO PRINCIPAL -->

                    </div>

                    <!-- CAROUSEL MINI -->
                    <?php 
                            $sql_fotos = "SELECT * FROM cadastro_produtos_fotos
                            where foto_produto_id = $prod_id
                            order by foto_principal";
                            $stmt_fotos = $PDO->prepare($sql_fotos);
                            $stmt_fotos->execute();
                            $rows_fotos = $stmt_fotos->rowCount();
                            $cont=1;
                            if ($rows_fotos > 1) {
                                echo'<div class="linha" style="margin-top: 10px"><div class="colunas lg-12"><div class="mini-carousel"><div class="owl-carousel2">';
                                
                                while ($result_fotos = $stmt_fotos->fetch()) {
                                    echo'
                                        <div class="bloco-mini" onclick="fechar()">
                                            <img class="demo w3-opacity w3-hover-opacity-off" src="webapp/uploads/produtos/'.$result_fotos['foto_nome'].'" onclick="currentDiv('.$cont.')">
                                        </div>
                                    ';
                                    $cont++;
                                }
                                echo'</div></div></div></div>';
                            }
                    ?>
                    <!-- FIM CAROUSEL MINI -->

                </div>

                <!-- DESCRIÇÃO E TÍTULO DO PRODURO -->
                <div class="colunas lg-6 md-6 pq-12">
                        <div style="position: relative; height: 400px">

                            <div class="info-produtos">
                                <h1>
                                    <span><?php echo $prod_titulo ?></span>
                                </h1>
                                <p>
                                    <?php echo $prod_descricao ?>
                                </p>
                            </div>
                    
                            <div class="btn-orca" id="btn-orca" onclick="gtag('event','Click', {'event_category':'Produtos','event_label':'Solicite um Orçamento','value':0});">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Solicitar um orçamento
                            </div>

                        </div>
                </div>
                <!-- FIM DESCRICAO -->

            </div>
            <!-- FIM PG PRODUTO -->

            <!-- CAROUSEL DE PRODUTOS -->
            <?php
                $sql = "SELECT * FROM cadastro_produtos
                LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
                left join cadastro_produtos_fotos on cadastro_produtos_fotos.foto_produto_id = cadastro_produtos.prod_id
                where cp_subcategoria = $sub_id and prod_id != $prod_id and prod_status = 1 and cp_categoria = $cat_id
                group by prod_id";
                $stmt = $PDO->prepare($sql);
                $stmt->execute();
                $rows = $stmt->rowCount();

                if($rows > 0){
                    echo"<div style='background: #fff'>
                    <div class='linha bloco-galeria'>
                        <div class='colunas lg-12 md-12 pq-12'>
                            <h2>Outros produtos de
                                $sub_titulo 
                            </h2>
                            <div id='galeria'>
                                <div class='owl-carousel'>
                                    ";
                                            while ($result = $stmt->fetch()) {
                                                echo"<a href='produtos/$url_cat/$url_sub/".$result['prod_url']."'>
                                                    <div class='carousel-fotos'>
                                                        <img src='webapp/uploads/produtos/".$result['foto_nome']."' title='".$result['prod_titulo']."' alt='".$result['prod_titulo']."'";?> onerror="this.src='core/imagens/logo2.png'"
                                                        <?php echo">
                                                        <p>". truncate(strip_tags(preg_replace("/<img[^>]+\>/i", " ", str_replace("<br />", " ", str_replace("</p>", " ", str_replace("<p>", " ", $result['prod_titulo']))))), 50) ."</p>
                                                    </div></a>";
                                            }
                                    echo"
                                </div>
                            </div>
                        </div>
                    </div></div>";
                } 
             ?>
                <!-- FIM CAROUSEL -->

                <!-- FORMULARIO E CONTATOS -->
            
                <?php include('formulario.php');?>
                      
                <!-- FIM FORMULARIO -->

                <!-- QUANDO A URL NÃO RECEBE NENHUM PRODUTO APARECE AS CATEGORIAS -->
                <?php elseif(!$pag_produtos) : ?>

                <div class="imginfo">
                    <h2>Produtos</h2>
                    <p>Selecione o segmento que deseja visualizar os produtos/serviços.</p>
                    <?php 
                        $sql_box = "SELECT * FROM cadastro_categorias
                        order by cat_destaque";
                        $stmt_box = $PDO->prepare($sql_box);
                        $stmt_box->execute();
                        $rows_box = $stmt_box->rowCount();
                        if ($rows_box > 0) {
                            while ($result_box = $stmt_box->fetch()) {
                                echo'
                                    <div class=" view view-first primeiro">
                                            <img src="webapp/uploads/categorias/'.$result_box['cat_imagem'].'" title="'.$result_box['cat_titulo'].'" alt="'.$result_box['cat_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'"
                    <?php echo' />
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
                <?php include('marcas.php') ?>
                <?php endif ?>
                <!-- FIM CATEGORIAS -->

        </section>
    </main>

    <section>
        <footer>
            <?php include('core/mod_rodape/rodape.php');?>
        </footer>
    </section>

</body>

</html>

<!-- owlCarousel -->
<link rel="stylesheet" href="core/css/owl.carousel.css">
<link rel="stylesheet" href="core/css/owl.carousel2.css">
<script src="core/mod_includes/js/owl.carousel.js"></script>

<script type="text/javascript">
    jQuery('.owl-carousel ').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        margin: 20,
        responsiveClass: true,
        dotClass: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                nav: false
            },

            850: {
                items: 3,
                nav: false
            },
            1450: {
                items: 4,
                nav: false
            }
        }
    })
</script>

<script type="text/javascript">
    jQuery('.owl-carousel2 ').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        margin: 20,
        responsiveClass: true,
        dotClass: false,
        nav: false,
        responsive: {
            0: {
                items: 1,
                nav: false
            },

            850: {
                items: 1,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            },
            1450: {
                items: 4,
                nav: false
            }
        }
    })
</script>
<!-- Fim ----- owlCarousel -->

<!-- JSON ESTADOS E CIDADES -->
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
<!-- FIM JSON -->

<!-- mini carousel -->
<script>
    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");

        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";

        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-opacity-off";
    }
</script>
<!-- fim mini carousel -->

<script>
    function fechar() {
        $('#foto').css('display', 'none');
    }
</script>

<link rel="stylesheet" type="text/css" href="core/mod_includes/js/shadowbox/shadowbox.css">
<script type="text/javascript" src="core/mod_includes/js/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
    Shadowbox.init();
</script>