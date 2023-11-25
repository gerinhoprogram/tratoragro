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

        <?php if($message = $this->session->flashdata('sucesso')) : ?>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class='fas fa-check'></i></strong>&nbsp;&nbsp;
                    <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($message = $this->session->flashdata('error')) : ?>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp;
                    <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">

                <fieldset class="mb-4 border p-2">
                    <legend class="font-medium">Dados básicos</legend>
                    <div class="form-group row mb-5">
                        <div class="col-md-4">
                            <label for="sistema_razao_social" class="form-label">Razão social</label>
                            <input readonly type="text" class="form-control" name="sistema_razao_social" value="<?php echo $sistema->sistema_razao_social ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sistema_nome_fantasia" class="form-label">Nome fantasia (Título no site)</label>
                            <input readonly type="text" class="form-control" name="sistema_nome_fantasia" value="<?php echo $sistema->sistema_nome_fantasia ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sistema_cnpj" class="form-label">CNPJ</label>
                            <input readonly type="text" class="form-control cnpj" name="sistema_cnpj" value="<?php echo $sistema->sistema_cnpj ?>">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4 border p-2">
                    <legend class="font-medium">Contato</legend>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label for="sistema_telefone_fixo" class="form-label">Telefone</label>
                            <input readonly type="text" class="form-control sp_celphones" name="sistema_telefone_fixo" value="<?php echo $sistema->sistema_telefone_fixo ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_segunda_opcao" class="form-label">2ª opção de telefone</label>
                            <input readonly type="text" class="form-control" name="sistema_telefone_segunda_opcao" value="<?php echo $sistema->sistema_telefone_segunda_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_terceira_opcao" class="form-label">3ª opção de telefone</label>
                            <input readonly type="text" class="form-control" name="sistema_telefone_terceira_opcao" value="<?php echo $sistema->sistema_telefone_terceira_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_telefone_quarta_opcao" class="form-label">4ª opção de telefone</label>
                            <input readonly type="text" class="form-control" name="sistema_telefone_quarta_opcao" value="<?php echo $sistema->sistema_telefone_quarta_opcao ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label for="sistema_whatsap" class="form-label">Whatsap</label>
                            <input readonly type="text" class="form-control sp_celphones" name="sistema_whatsap" value="<?php echo $sistema->sistema_whatsap ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_whatsap_segunda_opcao" class="form-label">2ª opção de Whatsap</label>
                            <input readonly type="text" class="form-control" name="sistema_whatsap_segunda_opcao" value="<?php echo $sistema->sistema_whatsap_segunda_opcao ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_fax" class="form-label">Fax</label>
                            <input readonly type="text" class="form-control" name="sistema_fax" value="<?php echo $sistema->sistema_fax ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="sistema_site_url" class="form-label">Site</label>
                            <input readonly type="text" class="form-control" name="sistema_site_url" aria-describedby="emailHelp" placeholder="Site url" value="<?php echo $sistema->sistema_site_url ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sistema_email" class="form-label">E-mail</label>
                            <input readonly type="email" class="form-control" name="sistema_email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $sistema->sistema_email ?>">
                        </div>
                        
                    </div>
                </fieldset>
                <fieldset class="mb-4 border p-2">
                    <legend class="font-medium">Endereço</legend>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="sistema_endereco" class="form-label">Rua | Av.</label>
                            <input readonly type="text" class="form-control" name="sistema_endereco" value="<?php echo $sistema->sistema_endereco ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sistema_cidade" class="form-label">Cidade</label>
                            <input readonly type="text" class="form-control" name="sistema_cidade" value="<?php echo $sistema->sistema_cidade ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="sistema_estado" class="form-label">Estado</label>
                            <input readonly type="text" class="form-control uf" name="sistema_estado" value="<?php echo $sistema->sistema_estado ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-md-3">
                            <label for="sistema_cep" class="form-label">Cep</label>
                            <input readonly type="text" class="form-control cep" name="sistema_cep" value="<?php echo $sistema->sistema_cep ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="sistema_numero" class="form-label">Número</label>
                            <input readonly type="text" class="form-control" name="sistema_numero" value="<?php echo $sistema->sistema_numero ?>">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-4 border p-2">
                    <legend class="font-medium">Redes sociais</legend>

                    <div class="form-group row mb-5">
                        <div class="col-md-4">
                            <label for="sistema_facebook" class="form-label">Facebook</label>
                            <input readonly type="text" class="form-control" name="sistema_facebook" value="<?php echo $sistema->sistema_facebook ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sistema_cidade" class="form-label">Instagram</label>
                            <input readonly type="text" class="form-control" name="sistema_facebook" value="<?php echo $sistema->sistema_instagram ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sistema_linkedin" class="form-label">Linkedin</label>
                            <input readonly type="text" class="form-control" name="sistema_linkedin" value="<?php echo $sistema->sistema_linkedin ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-12">
                            <label for="sistema_youtube" class="form-label">You Tube</label>
                            <input readonly type="text" class="form-control" name="sistema_youtube" value="<?php echo $sistema->sistema_youtube ?>">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4 border p-2">
                    <legend class="font-medium">A Empresa</legend>

                    <div class="form-group row mb-5">
                        <div class="col-md-12">
                            <label for="sistema_descricao" class="form-label">Descição</label>
                            <textarea readonly class="form-control" rows="6" name="sistema_descricao" aria-describedby="emailHelp" placeholder="Descrição"><?php echo $sistema->sistema_descricao ?></textarea>
                        </div>
                    </div>
                </fieldset>

                <a title="Editar" href="<?php echo base_url('sistema/editar/'.$sistema->id) ?>" class="btn btn-md btn-primary"><i class='fas fa-edit'></i>Editar</a>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->