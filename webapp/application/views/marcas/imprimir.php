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
            </div>
            <div class="card-body">
                <form method="POST" name="form_add" class="user">

                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="marca_status" class="form-label">Status</label>
                                <select name="marca_status" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="0">Inativo</option>
                                    <option value="1">Ativo</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="marca_detaque" class="form-label">Detaque</label>
                                <select name="marca_destaque" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                          
                        </div>

                        <button type="submit" class="btn btn-success btn-md"><i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Gerar</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->