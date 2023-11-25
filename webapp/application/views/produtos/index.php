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
                    <strong><i class='far fa-check'></i></strong>&nbsp;&nbsp;
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
                <a title="Cadastrar" href="<?php echo base_url('produtos/adicionar'); ?>" class="btn btn-success btn-md float-right"><i class="fas fa-plus"></i>&nbsp;Novo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th class="text-center">Ativo</th>
                                <th class="text-center">Destaque</th>
                                <th class="p-1 no-sort">Mais informações</th>
                                <th class="text-center no-sort">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos as $produto) : ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $produto->prod_id ?>
                                </td>
                                <td>
                                    <?php echo $produto->prod_titulo ?>
                                </td>
                                <td>
                                    <?php echo ($produto->cat_titulo ? $produto->cat_titulo : '<span class="badge badge-warning btn-sm">Sem categoria</span>') ?>
                                </td>
                                <td>

                                    <?php foreach($aux_sub as $sub){

                                        echo ($sub->cp_produto == $produto->prod_id ? $sub->scat_titulo."<br>" : '');

                                    }?>
                                
                                </td>
                                
                                <td class="text-center">
                                    <?php echo ($produto->prod_status == 1 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>') ?>
                                </td>
                                <td class="text-cente text-center">
                                        <?php echo ($produto->prod_destaque == 1 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>') ?>
                                </td>
                                <td class="text-center">
                                    <?php //echo ($produto->prod_imagem ? '<a title="Foto" href="javascript(void)" data-toggle="modal" data-target="#produto-foto'.$produto->prod_id.'"><i class="fas fa-file-image fa-2x text-gray-800"></i></a>' : '') ?>
                                    <?php echo ($produto->prod_descricao ? '<a title="Descrição" href="javascript(void)" data-toggle="modal" data-target="#produto-descricao'.$produto->prod_id.'"><i class="fas fa-file-alt fa-2x text-gray-800"></i></a>' : '' ) ?>
                                    <?php echo ($produto->prod_video ? '<a title="Vídeo" target="_blanck" href="'.$produto->prod_video.'"><i class="fas fa-file-video fa-2x text-gray-800"></i></a>' : '' ) ?>
                                </td>
                                <td class="text-center">
                                            <a title="Editar" href="<?php echo base_url('produtos/editar/'.$produto->prod_id) ?>" class="btn btn-sm btn-primary"><i class='fas fa-edit'></i></a>
                                            <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#produto<?php echo $produto->prod_id; ?>" class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>

                            <!-- modal excluir -->
                            <div class="modal fade" id="produto<?php echo $produto->prod_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                                        <div class="modal-body">Para excluir este produto clica em "Sim".</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Não</button>
                                            <a class="btn btn-danger btn-md" href="<?php echo base_url('produtos/deletar/'.$produto->prod_id) ?>">Sim</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal foto -->
                            <div class="modal fade" id="produto-foto<?php echo $produto->prod_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $produto->prod_titulo ?></h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">

                                        <img src="<?php //echo base_url('uploads/usuarios/').$produto->prod_imagem ?>" alt="" width="100%">

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- modal descrição -->
                             <div class="modal fade" id="produto-descricao<?php echo $produto->prod_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $produto->prod_titulo ?></h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo ($produto->prod_modelo ? '<p>Modelo: '.$produto->prod_modelo.'</p>' : '') ?>
                                            <?php echo ($produto->prod_marca ? '<p>Marca: '.$produto->marca_nome.'</p>' : '') ?>
                                            <p><?php echo $produto->prod_descricao ?></p>

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