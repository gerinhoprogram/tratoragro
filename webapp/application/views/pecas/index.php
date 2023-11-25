<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
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
            <div class="card-header py-3">
                <a title="Cadastrar" href="<?php echo base_url('pecas/adicionar'); ?>" class="btn btn-success btn-md float-right"><i class="fas fa-plus"></i>&nbsp;Nova</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="no-sort">Foto</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th class="no-sort">Descrição</th>
                                <th class="text-center">Status</th>
                                <th class="text-center no-sort">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pecas as $peca) : ?>
                            <tr>
                                <td>
                                    <?php echo $peca->peca_id ?>
                                </td>
                                <td class="text-center">
                                    <?php echo ($peca->peca_foto ? '<a title="Foto" href="javascript(void)" data-toggle="modal" data-target="#peca-foto'.$peca->peca_id.'"><i class="fas fa-file-image fa-2x text-gray-800"></i></a>' : '') ?>
                                </td>
                                <td>
                                    <?php echo $peca->peca_nome ?>
                                </td>
                                <td>
                                    <?php echo $peca->marca_nome ?>
                                </td>
                        
                                <td class="text-center">
                                    <?php echo ($peca->peca_descricao ? '<a title="Descrição" href="javascript(void)" data-toggle="modal" data-target="#peca-descricao'.$peca->peca_id.'"><i class="fas fa-file-alt fa-2x text-gray-800"></i></a>' : '' ) ?></td>
                                <td class="text-center">
                                    <?php echo ($peca->peca_status == 1 ? '<span class="badge badge-info btn-sm">Ativo</span>' : '<span class="badge badge-danger btn-sm">Inativo</span>') ?></td>
                                <td class="text-center">
                                    <a title="Editar" href="<?php echo base_url('pecas/editar/'.$peca->peca_id) ?>" class="btn btn-sm btn-primary"><i class='fas fa-edit'></i></a>
                                    <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#peca<?php echo $peca->peca_id; ?>" class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>

                            <!-- modal excluir -->
                            <div class="modal fade" id="peca<?php echo $peca->peca_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                                        <div class="modal-body">Para excluir clica em "Sim".</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Não</button>
                                            <a class="btn btn-danger btn-md" href="<?php echo base_url('pecas/deletar/'.$peca->peca_id) ?>">Sim</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal descricao -->
                            <div class="modal fade" id="peca-descricao<?php echo $peca->peca_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <?php echo $peca->peca_nome ?> </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?php echo $peca->peca_descricao ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal foto -->
                            <div class="modal fade" id="peca-foto<?php echo $peca->peca_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <?php echo $peca->peca_nome ?> </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo base_url('uploads/pecas/').$peca->peca_foto ?>" alt="" width="100%">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->