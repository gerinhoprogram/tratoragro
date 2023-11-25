

    <?php $this->load->view('layout/sidebar') ?>

<!-- Main Content -->
<div id="content">

  <?php $this->load->view('layout/navbar') ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
      </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
              <form method="POST" name="form_edit">
              <fieldset class="mb-4 border p-2">
                  <legend class="font-medium">Dados</legend>
                  <div class="form-group row">
                        <div class="col-md-6">
                              <label for="nome" class="form-label">*Nome</label>
                              <input type="text" class="form-control" name="first_name" aria-describedby="emailHelp" placeholder="Nome" value="<?php echo $usuario->first_name ?>">
                              <?php echo form_error('first_name','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-6">
                              <label for="Sobrenome" class="form-label">Sobrenome</label>
                              <input type="text" class="form-control" name="last_name" aria-describedby="emailHelp" placeholder="Sobrenome" value="<?php echo $usuario->last_name ?>">
                              <?php echo form_error('last_name','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                  </div>

                  <div class="form-group row">
                      <div class="col-md-4">
                          <label for="usuario" class="form-label">*Usuário</label>
                          <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="usuário" value="<?php echo $usuario->username ?>">
                          <?php echo form_error('username','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                      <div class="col-md-4">
                          <label for="ativo" class="form-label">Ativo</label>
                          <select name="active" class="form-control" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '') ?>>
                                <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : '' ?>>Não</option>
                                <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : '' ?>>Sim</option>
                              </select>
                        </div>
                        <div class="col-md-4">
                          <label for="perfil" class="form-label">Perfil de acesso</label>
                          <select name="perfil_usuario" class="form-control" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '') ?>>
                                <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : '' ?>>Usuário</option>
                                <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : '' ?>>Administrador</option>
                              </select>
                        </div>
                  </div>
                  </fieldset>

                <fieldset class="mb-4 border p-2">
                  <legend class="font-medium">Login</legend>

                  <div class="form-group row">
                        <div class="col-md-6">
                                <label for="email" class="form-label">*E-mail (login)</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail" value="<?php echo $usuario->email ?>">
                                <?php echo form_error('email','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                          <label for="senha" class="form-label">* **Senha</label>
                          <input type="password" class="form-control" name="password" aria-describedby="emailHelp" placeholder="senha">
                          <?php echo form_error('password','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                        </div>
                        <div class="col-md-3">
                          <label for="confirm_password" class="form-label">* **Confirmar senha</label>
                          <input type="password" class="form-control" name="confirm_password" aria-describedby="emailHelp" placeholder="Confirmar senha">
                          <?php echo form_error('confirm_password','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                        </div>
                  </div>
                  </fieldset>

                  <fieldset class="mb-4 border p-2">
                        <legend class="font-medium">Explicativo</legend>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <small>* Campo de preenchimento obrigatório.</small><br>
                                <small>** Em caso de alteração de Senha, preencha os campos Senha e Confirmar senha. Caso contrário, não tem necessidade de preenchimento.</small><br>
                            </div>
                        </div>
                  </fieldset>

                  <input type="hidden" name="usuario_id" value="<?php echo $usuario->id ?>">
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
                                    <a title="Voltar" href="<?php echo base_url('usuarios') ?>" class="btn btn-danger btn-md"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Cancelar alterações</a>
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


