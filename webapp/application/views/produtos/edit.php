<?php $this->load->view('layout/sidebar') ?>

<style>
    .box {
        height: 290px;
        margin-bottom: 10px
    }
    
    .box img {
        height: 220px;
        width: 100%;
        object-fit: contain
    }
    .btn-remove{
        cursor: pointer;
    }
</style>

<?php 
// echo"<pre>";
// print_r($aux_sub);
// exit(); 

?>

<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('produtos') ?>">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $titulo ?>
                </li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                <form method="POST" name="form_edit" class="user">

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Dados</legend>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="prod_titulo" class="form-label">*Título</label>
                                <input type="text" class="form-control" name="prod_titulo" aria-describedby="emailHelp" value="<?php echo $produto->prod_titulo ?>">
                                <?php echo form_error('prod_titulo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="prod_video" class="form-label">Link para vídeo</label>
                                <input type="text" class="form-control" name="prod_video" aria-describedby="emailHelp" value="<?php echo $produto->prod_video ?>">
                                <?php echo form_error('prod_video','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for="prod_cat_principal" class="form-label">Categorias</label>
                                <select class="form-control categorias" name="prod_cat_principal">
                                   
                                <?php $cont = true; ?>
                                <?php foreach ($categorias as $categoria){

                                        foreach($aux_sub as $sub){
                                                if($cont){
                                                    echo '<option value="'.$categoria->cat_id.'" ' . ($categoria->cat_id == $sub->cp_categoria ? 'selected' : '').'>'. $categoria->cat_titulo .'</option>';
                                                    $cont = false;
                                                    $cat_id = $sub->cp_categoria;
                                                    $cont_sub++;
                                                } 
                                        }

                                        if($cat_id != $categoria->cat_id){
                                            echo '<option value="'.$categoria->cat_id.'">'. $categoria->cat_titulo .'</option>';
                                        }
                                        
                                    }   
                                ?>
                                
                                </select>
                                <?php echo form_error('prod_cat_principal','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                            </div>

                            <div class="col-md-5">
                                <label for="prod_categoria" class="form-label">Subcategorias <small>(Selecione várias)</small></label>
                                <select class="form-control subcategorias" multiple name="prod_categoria[]" id="box">
                                    <?php
                                  
                                        foreach ($subcategorias as $sucategoria){
                                            foreach($aux_sub as $sub){
                                                if($sub->cp_subcategoria == $sucategoria->scat_id){
                                                    echo '<option value="'.$sucategoria->scat_id.'" ' . ($sucategoria->scat_id == $sub->cp_subcategoria ? 'selected' : '').'>'. $sucategoria->scat_titulo .'</option>';
                                                    
                                                }  
                                            }

                                            if($cat_id == $sucategoria->scat_categoria){
                                               
                                                    if($sucategoria->scat_id != $aux_sub[0]->cp_subcategoria && $sucategoria->scat_id != $aux_sub[1]->cp_subcategoria && $sucategoria->scat_id != $aux_sub[2]->cp_subcategoria && $sucategoria->scat_id != $aux_sub[3]->cp_subcategoria && $sucategoria->scat_id != $aux_sub[4]->cp_subcategoria){
                                                        echo '<option value="'.$sucategoria->scat_id.'">'. $sucategoria->scat_titulo.'</option>';
                                                       
                                                    }
                                            
                                            }

                                        }
                                    ?>
                                </select>
                                <?php echo form_error('prod_categoria','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                            </div>

                            <div class="col-md-2">
                                <label for="prod_marca" class="form-label">Marcas</label>
                                <select class="form-control marcas" name="prod_marca">
                                <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca->marca_id ?>" 
                                            <?php echo $marca->marca_id == $produto->prod_marca ? 'selected' : '' ?>>
                                            <?php echo $marca->marca_nome?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="prod_tipo" class="form-label">Tipo</label>
                                <input type="text" class="form-control" name="prod_tipo" aria-describedby="emailHelp" value="<?php echo $produto->prod_tipo ?>">
                                <?php echo form_error('prod_tipo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="prod_modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control" name="prod_modelo" aria-describedby="emailHelp" value="<?php echo $produto->prod_modelo ?>">
                                <?php echo form_error('prod_modelo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="prod_status" class="form-label">**Status</label>
                                <select name="prod_status" class="form-control">
                                    <option value="0" <?php echo ($produto->prod_status == 0) ? 'selected' : '' ?>>Inativo</option>
                                    <option value="1" <?php echo ($produto->prod_status == 1) ? 'selected' : '' ?>>Ativo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="prod_destaque" class="form-label">***Destaque</label>
                                <select name="prod_destaque" class="form-control">
                                    <option value="0" <?php echo ($produto->prod_destaque == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($produto->prod_destaque == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Descrição</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="prod_descricao" class="form-label">Descreva seu produto</label>
                                <textarea class="form-control" rows="6" name="prod_descricao"><?php echo $produto->prod_descricao ?></textarea>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Fotos</legend>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Selecione várias fotos (PNG ou JPG | Tam. max.: 2000 MB | Alt. max.: 800px | Larg. Max. 800px)</label>
                                <div id="fileuploader" style="width: 100%">
                                </div>
                                <div id="erro_uploaded" class="text-danger">
                                </div>
                            </div>
                        </div>

                        <div id="uploaded_image" class="form-group row">

                            <?php foreach($produto_fotos as $foto) : ?>

                            <div class="col-md-3 text-center box">
                                <img src="<?php echo base_url('uploads/produtos/'.$foto->foto_nome) ?>" alt="" class="img-thumbnail mb-2 mr-1">
                                <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_nome ?>" />
                                <div class="btn btn-block btn-sm btn-danger btn-remove btn-icon">Retirar</div>
                                <div><input type="radio" <?php echo ($foto->foto_principal == 1) ? 'checked' : '' ?> name="foto_principal" value="<?php echo $foto->foto_nome ?>" />&nbsp;Foto principal</div>
                            </div>

                            <?php endforeach ?>
                        </div>

                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Explicativo</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <small>* Campo de preenchimento obrigatório.</small><br>
                                <small>** Campo Inativo não aparece no site.</small><br>
                                <small>*** Campo Destaque aparece nas primeiras posições na Home ou em outras páginas.</small>
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="prod_id" value="<?php echo $produto->prod_id ?>">
                    
                    <a title="Voltar" class="btn btn-info btn-md" href="javascript(void)" data-toggle="modal" data-target="#cancelar-alteracao"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                    <a title="Salvar" class="btn btn-success btn-md" href="javascript(void)" data-toggle="modal" data-target="#salvar-alteracao"><i class="fas fa-save"></i>&nbsp;Salvar</a>
                    
                    <!-- modal salvar -->
                    <div class="modal fade" id="salvar-alteracao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deseja salvar as alterações?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                Clique em salvar, e os dados serão atualizados! 
                                </div>
                                <div class="modal-footer">                
                                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Não salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal cancelar -->
                    <div class="modal fade" id="cancelar-alteracao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deseja cancelar as alterções?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                Ao clicar em Cancelar, as alterações não serão salvas!
                                </div>
                                <div class="modal-footer">                
                                    <a title="Voltar" href="<?php echo base_url('produtos') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
                                    <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Permanecer alterando</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
