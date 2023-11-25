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
                <form method="POST" name="form_add" class="user">

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Dados</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="marca_nome" class="form-label">*Nome da marca <small>(Não será permitido marcas com o mesmo nome.)</small></label>
                                <input type="text" class="form-control" name="marca_nome" aria-describedby="emailHelp" value="<?php echo set_value('marca_nome') ?>">
                                <?php echo form_error('marca_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="marca_telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control phone_with_ddd" name="marca_telefone" aria-describedby="emailHelp" value="<?php echo set_value('marca_telefone') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="marca_email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="marca_email" aria-describedby="emailHelp" value="<?php echo set_value('marca_email') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="marca_status" class="form-label">**Status</label>
                                <select name="marca_status" class="form-control">
                                    <option value="0">inativo</option>
                                    <option value="1">Ativo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="marca_destaque" class="form-label">***Destaque</label>
                                <select name="marca_destaque" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Foto</legend>
                        <div class="form-group row">

                            <div class="col-md-7">
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
                                <!-- mensagem de erro -->
                                <div id="marca_foto_troca"></div>
                            </div>

                            <!-- utiliza o arquivo marcas.js para aparece a foto no #box-foto-marca  -->
                            <div class="form-group col-md-5">
                                <div id="box-foto-marca"> </div>
                            </div>
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