<?php $this->load->view('layout/sidebar') ?>
<style>
    #box-foto-peca{
        height: 100px;
    }

    #box-foto-peca img{
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
                <li class="breadcrumb-item"><a href="<?php echo base_url('pecas') ?>">Peças</a></li>
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
                        <legend class="font-md">Dados</legend>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <label for="peca_nome" class="form-label">*Nome <small>(Não será permitido marcas com o mesmo nome.)</small></label>
                                <input type="text" class="form-control" name="peca_nome" aria-describedby="emailHelp" value="<?php echo $pecas->peca_nome ?>">
                                <?php echo form_error('peca_nome','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="peca_status" class="form-label">Status</label>
                                <select name="peca_status" class="form-control">
                                    <option value="0" <?php echo ($pecas->peca_status == 0) ? 'selected' : '' ?>>inativo</option>
                                    <option value="1" <?php echo ($pecas->peca_status == 1) ? 'selected' : '' ?>>Ativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="peca_marca" class="form-label">Marcas</label>
                                <select name="peca_marca" class="form-control marcas">
                                <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca->marca_id ?>" 
                                        <?php echo $marca->marca_id == $pecas->peca_marca ? 'selected' : '' ?>>
                                        <?php echo $marca->marca_nome ?>
                                        </option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                    <legend class="font-md">Descrição</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="peca_descricao" class="form-label">Descrição da peça/equipamento</label>
                                <textarea class="form-control" rows="6" name="peca_descricao"><?php echo $pecas->peca_descricao ?></textarea>
                            </div>
                        </div>
                    </fieldset>

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
                                    <input type="file" class="form-control" name="peca_foto">
                                    <div id="carregando"></div>
                                </div>
                            </div>
                            <?php if(!empty($pecas->peca_foto)) : ?>

                            <div class="form-group col-md-5">
                                <div id="box-foto-peca">
                                    <input type="hidden" name="peca_foto_troca" value="<?php echo $pecas->peca_foto ?>">
                                    <img src="<?php echo base_url('uploads/pecas/'.$pecas->peca_foto) ?>" alt="" onerror="this.src='<?php echo base_url('uploads/pecas/semfoto.png') ?>'">
                                </div>
                            </div>
                            
                            <?php else : ?>

                                <div class="form-group col-md-5">
                                    <div id="box-foto-peca"> </div>
                                </div>

                            <?php endif ?>
                        </div>
                    </fieldset>
        
                    <input type="hidden" name="peca_id" value="<?php echo $pecas->peca_id ?>">
                    
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
                                    <a title="Voltar" href="<?php echo base_url('pecas') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
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