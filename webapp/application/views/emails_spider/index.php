

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
              <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
          </nav>

          <?php if($message = $this->session->flashdata('sucesso')) : ?>
              <div class='row'>
                <div class='col-lg-12'>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class='far fa-smile-wink'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
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
                        <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp; <?php echo $message ?>
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
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Telefone</th>
                      <th>Assunto</th>
                      <th class="text-center no-sort">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($emails as $email) : ?>
                    <tr>
                      <td><?php echo formata_data_banco_com_hora($email->data) ?></td>
                      <td><?php echo $email->contato_nome ?></td>
                      <td><?php echo $email->contato_email ?></td>
                      <td><?php echo $email->contato_telefone ?></td>
                      <td><?php echo $email->contato_assunto ?></td>
                    
                      <td class="text-center">
                        <a title="Mensagem" href="javascript(void)" data-toggle="modal" data-target="#mensagem<?php echo $email->Id; ?>" class="btn btn-sm btn-info"><i class="fas fa-envelope"></i></a>
                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#email<?php echo $email->Id; ?>" class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                      </td>
                    </tr>

                      <!-- Logout Modal-->
                      <div class="modal fade" id="email<?php echo $email->Id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">Para excluir este e-mail clique em "Sim".</div>
                              <div class="modal-footer">
                                <button class="btn btn-info btn-md" type="button" data-dismiss="modal">Não</button>
                                <a class="btn btn-danger btn-md" href="<?php echo base_url('emails_spider/deletar/'.$email->Id) ?>">Sim</a>

                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Logout Modal-->
                      <div class="modal fade" id="mensagem<?php echo $email->Id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensagem de <?php echo $email->contato_nome ?></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body"><?php echo $email->contato_mensagem ?></div>
                              <div class="modal-footer">
                                <button class="btn btn-info btn-sm" type="button" data-dismiss="modal">Fechar</button>
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

     
