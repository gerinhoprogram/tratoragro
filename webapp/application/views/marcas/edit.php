<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('marcas') ?>">Marcas</a></li>
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
                            <div class="col-md-12">
                                <label for="marca_nome" class="form-label">*Nome marca <small>(Não será permitido marcas com o mesmo nome.)</small></label>
                                <input type="text" class="form-control" name="marca_nome" aria-describedby="emailHelp" value="<?php echo $marca->marca_nome ?>">
                                <?php echo form_error('marca_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="marca_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control phone_with_ddd" name="marca_telefone" aria-describedby="emailHelp" value="<?php echo $marca->marca_telefone ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="marca_email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="marca_email" aria-describedby="emailHelp" value="<?php echo $marca->marca_email ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="marca_status" class="form-label">**Status</label>
                                <select name="marca_status" class="form-control">
                                    <option value="0" <?php echo ($marca->marca_status == 0) ? 'selected' : '' ?>>inativo</option>
                                    <option value="1" <?php echo ($marca->marca_status == 1) ? 'selected' : '' ?>>Ativo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="marca_destaque" class="form-label">***Destaque</label>
                                <select name="marca_destaque" class="form-control">
                                    <option value="0" <?php echo ($marca->marca_destaque == 0) ? 'selected' : '' ?>>Não</option>
                                    <option value="1" <?php echo ($marca->marca_destaque == 1) ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                        </div>
                    </legend>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-md">Foto</legend>

                        <div class="form-group row">
                            <div class="form-group col-md-7">
                                <label>(PNG ou JPG | Tam. max.: 1500 MB | Alt. max.: 600px | Larg. Max. 600px)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="marca_foto">
                                    <div id="carregando"></div>
                                </div>
                            </div>
                            <?php if(!empty($marca->marca_foto)) : ?>

                            <div class="form-group col-md-5">
                                <div id="box-foto-marca">
                                    <input type="hidden" name="marca_foto_troca" value="<?php echo $marca->marca_foto ?>">
                                    <img src="<?php echo base_url('uploads/marcas/'.$marca->marca_foto) ?>" alt="" class='img-thumbnail mb-2 mr-1' onerror="this.src='<?php echo base_url('uploads/marcas/semfoto.png') ?>'">
                                </div>
                            </div>
                            
                            <?php else : ?>

                                <div class="form-group col-md-5">
                                    <div id="box-foto-marca"> </div>
                                </div>

                            <?php endif ?>
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
        
                    <input type="hidden" name="marca_id" value="<?php echo $marca->marca_id ?>">

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
                                    <a title="Voltar" href="<?php echo base_url('marcas') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
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