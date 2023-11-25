<?php $this->load->view('layout/sidebar') ?>
<style>
    #box-foto-categoria{
        height: 100px;
    }

    #box-foto-categoria img{
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
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Categorias</a></li>
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
                            <div class="col-md-9">
                                <label for="cat_titulo" class="form-label">*Nome <small>(Não será permitido nome de categoria igual)</small></label>
                                <input type="text" class="form-control" name="cat_titulo" aria-describedby="emailHelp" value="<?php echo $categoria->cat_titulo ?>">
                                <?php echo form_error('cat_titulo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="cat_destaque" class="form-label">**Destaque</label>
                                <select name="cat_destaque" class="form-control">
                                    <option value="0" <?php echo ($categoria->cat_destaque == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($categoria->cat_destaque == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                        </div>
                    </legend>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Foto</legend>

                        <div class="form-group row">
                            <div class="form-group col-md-7">
                                <label>(PNG ou JPG | Tam. max.: 700 KB | Alt. max.: 450px | Larg. Max. 300px)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="cat_imagem">
                                </div>
                            </div>
                            <?php if($categoria->cat_imagem) : ?>

                            <div class="form-group col-md-5">
                                <div id="box-foto-categoria">
                                    <input type="hidden" name="cat_foto" value="<?php echo $categoria->cat_imagem ?>">
                                    <img src="<?php echo base_url('uploads/categorias/'.$categoria->cat_imagem) ?>" alt="" class='img-thumbnail mb-2 mr-1' onerror="this.src='<?php echo base_url('uploads/categorias/semfoto.png') ?>'">
                                </div>
                            </div>
                            
                            <?php else : ?>

                                <div class="form-group col-md-5">
                                    <div id="box-foto-categoria"> </div>
                                </div>

                            <?php endif ?>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Explicativo</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <small>* Campo de preenchimento obrigatório.</small><br>
                                <small>** Campo Destaque aparece nas primeiras posições na Home ou em outras páginas.</small>
                            </div>
                        </div>
                    </fieldset>
        
                    <input type="hidden" name="cat_id" value="<?php echo $categoria->cat_id ?>">
                   
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
                                    <a title="Voltar" href="<?php echo base_url('categorias') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
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