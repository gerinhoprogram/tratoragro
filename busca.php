<?php include('header.php');?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<meta http-equiv="Content-Language" content="pt-br">

<head>
	<?php 
        $pagina = 'busca'; 
        $busca = '%'.$_POST['busca'].'%';
	?>

<link rel="stylesheet" type="text/css" href="core/css/estrutura.css">
	<title>Trator Agro</title>
</head>

<body>
	<header>
		<?php
			#region MOD INCLUDES
			include('core/mod_topo/topo.php');
		?>
	</header>
	<main>
            
			<div class="linha" style="margin-bottom: 50px">
          <div class="colunas lg-12 md-12">
          <p><i class="fas fa-search"></i> Resultado da busca</p>
          </div>
                <?php
                    $sql = "SELECT * FROM  cadastro_produtos
                    LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
                    LEFT JOIN cadastro_categorias ON cadastro_categorias .cat_id = aux_categoria_produtos.cp_categoria
                    LEFT JOIN cadastro_subcategorias ON cadastro_subcategorias.scat_id = aux_categoria_produtos.cp_subcategoria
                    LEFT JOIN cadastro_produtos_fotos on cadastro_produtos_fotos.foto_produto_id = cadastro_produtos.prod_id
                    LEFT JOIN cadastro_marcas on cadastro_marcas.marca_id = cadastro_produtos.prod_marca
                    WHERE prod_titulo like :prod_titulo OR prod_descricao like :prod_descricao OR marca_nome like :marca_nome and prod_status = 1 and marca_status = 1
                    group by prod_id
                    order by prod_destaque";
                    $stmt = $PDO->prepare($sql);
                    $stmt->bindValue(':prod_titulo', $busca); 
                    $stmt->bindValue(':prod_descricao', $busca); 
                    $stmt->bindValue(':marca_nome', $busca); 
                    $stmt->execute();
                    while($result = $stmt->fetch())
                    {
                        echo'
                            <div class="colunas lg-3 md-4" style="float: left">
                              <a href="produtos/'.$result['cat_url'].'/'.$result['scat_url'].'/'.$result['prod_url'].'">
                                  <div class="bloco-produtos">
                                      <span  class="id_prod">ID: '.$result['prod_id'].'</span>
                                      '.($result['prod_destaque'] == 1 ? '<span class="destaque">Destaque</span>' : '').'
                                                        
                                  <img src="webapp/uploads/produtos/'.$result['foto_nome'].'" alt="'.$result['prod_titulo'].'" title="'.$result['prod_titulo'].'" ';?> onerror="this.src='core/imagens/logo2.png'"<?php echo'>
                                      <p class="legenda">'.$result['prod_titulo'].'</p>
                                  </div>
                              </a>
                            </div>
                        ';
                    }	

                ?>
		   </div>
		<?php
        include('marcas.php');
		include('core/mod_rodape/rodape.php');
		?>
	</main>
</body>

</html>