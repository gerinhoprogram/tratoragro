<?php $this->load->view('layout/sidebar') ?>


<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar') ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Links rápidos</h1>


        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="nav-link p-0" href="<?php echo base_url('marcas') ?>">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-link"></i>&nbsp;Gerenciar Marcas</div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $cont_marcas->soma ?>&nbsp;Cadastradas <a title="Imprimir" target="_blanck" href="<?php echo base_url('marcas/pdf/') ?>"><i class="fas fa-download text-gray-800"></i></a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-industry fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-left-success shadow py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="nav-link p-0" href="<?php echo base_url('categorias') ?>">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-link"></i>&nbsp;Gerenciar Categorias</div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $cont_categorias->soma ?>&nbsp;Cadastradas <a title="Imprimir" target="_blanck" href="<?php echo base_url('categorias/pdf/') ?>"><i class="fas fa-download text-gray-800"></i></a></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sitemap fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="nav-link p-0" href="<?php echo base_url('pecas') ?>">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-link"></i>&nbsp;Gerenciar Peças</div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $cont_pecas->soma ?>&nbsp;Cadastradas <a title="Imprimir" target="_blanck" href="<?php echo base_url('pecas/pdf/') ?>"><i class="fas fa-download text-gray-800"></i></a></div>
                            </div>
                            <div class="col-auto">
                            <i class="fab fa-whmcs fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="nav-link p-0" href="<?php echo base_url('subcategorias') ?>">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-link"></i>&nbsp;Gerenciar Subcategorias</div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $cont_subcategorias->soma ?>&nbsp;Cadastradas <a title="Imprimir" target="_blanck" href="<?php echo base_url('subcategorias/pdf/') ?>"><i class="fas fa-download text-gray-800"></i></a></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bars fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a class="nav-link p-0" href="<?php echo base_url('produtos') ?>">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i class="fas fa-link"></i>&nbsp;Gerenciar Produtos</div>
                                </a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $cont_produtos->soma ?>&nbsp;Cadastrados <a title="Imprimir" target="_blanck" href="<?php echo base_url('produtos/pdf/') ?>"><i class="fas fa-download text-gray-800"></i></a></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tractor fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-xl-4 col-md-6 text-center">
                <img src="<?php echo base_url('public/img/modulos.svg') ?>" width="100%" alt="">
            </div>

        
        </div>



    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->