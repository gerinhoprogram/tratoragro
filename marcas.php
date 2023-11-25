
<div class="fundocinza">
    <div class="linha">

        <?php 

            if($pagina == 'categorias'){
                $sql_marcas = "SELECT * FROM cadastro_marcas
                left join cadastro_produtos on cadastro_produtos.prod_marca = cadastro_marcas.marca_id
                LEFT JOIN aux_categoria_produtos ON aux_categoria_produtos.cp_produto = cadastro_produtos.prod_id
                LEFT JOIN cadastro_categorias ON cadastro_categorias .cat_id = aux_categoria_produtos.cp_categoria

                where cp_categoria = $categoria_id and marca_status = 1
                group by marca_id 
                order by marca_destaque";
            }else{
                $sql_marcas = "SELECT * FROM cadastro_marcas
                where marca_status = 1
                order by marca_destaque
                limit 30";
            }
            
             $stmt_marcas = $PDO->prepare($sql_marcas);
             $stmt_marcas->execute();
             $rows_marcas = $stmt_marcas->rowCount();
             if ($rows_marcas > 0) {
                 while ($result_marcas = $stmt_marcas->fetch()) {
                     echo'<div class="colunas lg-2 md-4 pq-6" style="float: left">
                        <div class="bloco-marcas"><img src="webapp/uploads/marcas/'.$result_marcas['marca_foto'].'" title="'.$result_marcas['marca_nome'].'"></div>
                        </div>';
                 }
            }
        ?>

    </div>
</div>