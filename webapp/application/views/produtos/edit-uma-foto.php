<?php $this->load->view('layout/sidebar') ?>

<style>
    #box-foto-usuario {
        height: 100px;
    }
    
    #box-foto-usuario img {
        width: 100%;
        height: 100px;
        object-fit: contain
    }
</style>
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
                                <label for="prod_titulo" class="form-label">*Título <small>(Não será permitido nome de produto igual)</small></label>
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
                                <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria->cat_id ?>" 
                                        <?php echo $categoria->cat_id == $produto->prod_cat_principal ? 'selected' : '' ?>>
                                        <?php echo $categoria->cat_titulo ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                                <?php echo form_error('prod_cat_principal','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                            </div>

                            <div class="col-md-5">
                                <label for="prod_categoria" class="form-label">Subcategorias</label>
                                <select class="form-control subcategorias" name="prod_categoria">
                                <?php foreach ($subcategorias as $subcategoria): ?>
                                        <option value="<?php echo $subcategoria->scat_id ?>" 
                                        <?php echo $subcategoria->scat_id == $produto->prod_categoria ? 'selected' : '' ?>>
                                        <?php echo $subcategoria->scat_titulo ?>
                                        </option>
                                <?php endforeach ?>
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
                                <label for="prod_status" class="form-label">Status</label>
                                <select name="prod_status" class="form-control">
                                    <option value="0" <?php echo ($produto->prod_status == 0) ? 'selected' : '' ?>>Inativo</option>
                                    <option value="1" <?php echo ($produto->prod_status == 1) ? 'selected' : '' ?>>Ativo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="prod_destaque" class="form-label">Destaque</label>
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
                        <legend class="font-medium">Foto</legend>

                        <div class="form-group row">
                            <div class="form-group col-md-7">
                                <label>(PNG ou JPG | Tam. max.: 2000px | Alt. max.: 1500px | Larg. Max. 1500px)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="prod_imagem">
                                </div>
                            </div>
                            <?php if(!empty($produto->prod_imagem)) : ?>
                                <div class="form-group col-md-5">
                                    <div id="box-foto-usuario">
                                        <input type="hidden" name="user_foto" value="<?php echo $produto->prod_imagem ?>">
                                        <img src="<?php echo base_url('uploads/usuarios/'.$produto->prod_imagem) ?>" alt="" onerror="this.src='<?php echo base_url('uploads/categorias/semfoto.png') ?>'">
                                    </div>
                                </div>
                            <?php else : ?>

                                <div class="form-group col-md-5">
                                     <div id="box-foto-usuario"> </div>
                                </div>

                            <?php endif ?>
                        </div>
                    </fieldset>

                    <input type="hidden" name="prod_id" value="<?php echo $produto->prod_id ?>">

                    <a title="Voltar" href="<?php echo base_url('produtos') ?>" class="btn btn-primary btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Voltar</a>
                    <button type="submit" class="btn btn-success btn-md"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->