<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $titulo ?>
                </li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_edit">
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Dados básicos</legend>
                        <div class="form-group row mb-5">
                            <div class="col-md-4">
                                <label for="sistema_razao_social" class="form-label">*Razão social</label>
                                <input type="text" class="form-control" name="sistema_razao_social" aria-describedby="emailHelp" placeholder="Razão social" value="<?php echo $sistema->sistema_razao_social ?>">
                                <?php echo form_error('sistema_razao_social','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="sistema_nome_fantasia" class="form-label">*Nome fantasia (Título no site)</label>
                                <input type="text" class="form-control" name="sistema_nome_fantasia" placeholder="Nome fantasia" value="<?php echo $sistema->sistema_nome_fantasia ?>">
                                <?php echo form_error('sistema_nome_fantasia','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="sistema_cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj ?>">
                                <?php echo form_error('sistema_cnpj','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Contato</legend>
                        <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label for="sistema_telefone_fixo" class="form-label">Telefone</label>
                            <input  type="text" class="form-control sp_celphones" name="sistema_telefone_fixo" value="<?php echo $sistema->sistema_telefone_fixo ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_segunda_opcao" class="form-label">2ª opção de telefone</label>
                            <input  type="text" class="form-control" name="sistema_telefone_segunda_opcao" value="<?php echo $sistema->sistema_telefone_segunda_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_terceira_opcao" class="form-label">3ª opção de telefone</label>
                            <input  type="text" class="form-control" name="sistema_telefone_terceira_opcao" value="<?php echo $sistema->sistema_telefone_terceira_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_quarta_opcao" class="form-label">4ª opção de telefone</label>
                            <input  type="text" class="form-control" name="sistema_telefone_quarta_opcao" value="<?php echo $sistema->sistema_telefone_quarta_opcao ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label for="sistema_whatsap" class="form-label">Whatsap</label>
                            <input  type="text" class="form-control sp_celphones" name="sistema_whatsap" value="<?php echo $sistema->sistema_whatsap ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_whatsap_segunda_opcao" class="form-label">2ª opção de Whatsap</label>
                            <input  type="text" class="form-control" name="sistema_whatsap_segunda_opcao" value="<?php echo $sistema->sistema_whatsap_segunda_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_fax" class="form-label">Fax</label>
                            <input  type="text" class="form-control" name="sistema_fax" value="<?php echo $sistema->sistema_fax ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="sistema_site_url" class="form-label">Site</label>
                            <input  type="text" class="form-control" name="sistema_site_url" aria-describedby="emailHelp" placeholder="Site url" value="<?php echo $sistema->sistema_site_url ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sistema_email" class="form-label">E-mail</label>
                            <input  type="email" class="form-control" name="sistema_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $sistema->sistema_email ?>">
                        </div>
                        
                    </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Endereço</legend>
                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="sistema_endereco" class="form-label">Rua | Av.</label>
                                <input type="text" class="form-control" name="sistema_endereco" aria-describedby="emailHelp" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco ?>">
                                <?php echo form_error('sistema_endereco','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-4">
                                <label for="sistema_cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="sistema_cidade" aria-describedby="emailHelp" placeholder="Cidade" value="<?php echo $sistema->sistema_cidade ?>">
                                <?php echo form_error('sistema_cidade','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="sistema_estado" class="form-label">Estado</label>
                                <input type="text" class="form-control uf" name="sistema_estado" aria-describedby="emailHelp" placeholder="Estado" value="<?php echo $sistema->sistema_estado ?>">
                                <?php echo form_error('sistema_estado','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mb-5">

                            <div class="col-md-3">
                                <label for="sistema_cep" class="form-label">Cep</label>
                                <input type="text" class="form-control cep" name="sistema_cep" aria-describedby="emailHelp" placeholder="CEP" value="<?php echo $sistema->sistema_cep ?>">
                                <?php echo form_error('sistema_cep','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="sistema_numero" class="form-label">Número</label>
                                <input type="text" class="form-control" name="sistema_numero" aria-describedby="emailHelp" placeholder="Número" value="<?php echo $sistema->sistema_numero ?>">
                                <?php echo form_error('sistema_numero','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                            <legend class="font-medium">Redes sociais</legend>

                            <div class="form-group row mb-5">
                                <div class="col-md-4">
                                    <label for="sistema_facebook" class="form-label">Facebook</label>
                                    <input  type="text" class="form-control" name="sistema_facebook" value="<?php echo $sistema->sistema_facebook ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="sistema_cidade" class="form-label">Instagram</label>
                                    <input  type="text" class="form-control" name="sistema_facebook" value="<?php echo $sistema->sistema_instagram ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="sistema_linkedin" class="form-label">Linkedin</label>
                                    <input  type="text" class="form-control" name="sistema_linkedin" value="<?php echo $sistema->sistema_linkedin ?>">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-12">
                                    <label for="sistema_youtube" class="form-label">You Tube</label>
                                    <input  type="text" class="form-control" name="sistema_youtube" value="<?php echo $sistema->sistema_youtube ?>">
                                </div>
                            </div>
                    </fieldset>
                    <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">A Empresa</legend>
                        <div class="form-group row mb-5">
                            <div class="col-md-12">
                                <label for="sistema_descricao" class="form-label">Descição da empresa</label>
                                <textarea class="form-control" rows="6" name="sistema_descricao" aria-describedby="emailHelp" placeholder="Descrição"><?php echo $sistema->sistema_descricao ?></textarea>
                                <?php echo form_error('sistema_descricao','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="id" value="<?php echo $sistema->id ?>">

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
                                    <a title="Voltar" href="<?php echo base_url('sistema') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
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