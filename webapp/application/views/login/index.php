<script>
function mostrarSenha() {
  var tipo = document.getElementById("password");
  var ver = document.getElementById("ver");
  if(tipo.type == "password"){
      tipo.type = "text";
      ver.value = 'Ocultar senha'
  }else{
      tipo.type = "password";
      ver.value = 'Mostrar Senha'
  }
}
</script>
<div class="container pt-1">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-1">

        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12 d-none d-lg-block text-center pt-4">
                            <img class="img-fluid" src="<?php echo base_url('public/img/logo.png') ?>" alt="">
                        </div>
                        <div class="col-lg-12">
                            <div class="p-5">
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
                                <?php if($message = $this->session->flashdata('info')) : ?>
                                <!-- <div class='row'>
                                    <div class='col-lg-12'>
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <strong><i class='fas fa-exclamation-triangle'></i></strong>&nbsp;&nbsp;
                                            <?php echo $message ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                        </div>
                                    </div>
                                </div> -->
                                <?php endif; ?>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Acesso restrito!</h1>
                                </div>
                                <form class="user p-5" name="form_aunteticar" method="POST" action="<?php echo base_url('login/autenticar') ?>">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" class="form-control p-4 form-control-user" id="email" placeholder="Login (email)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-unlock-alt"></i>
                                                </div>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control p-4 form-control-user" id="password" placeholder="Senha">
                                        </div>
                                    </div>
                                    <input value="Mostrar senha" type="button" onclick="mostrarSenha()" id='ver' class="btn btn-warning btn-sm float-left">
                                    <button type="submit" class="btn btn-primary btn-lg float-right">
                                      Entrar
                                    </button>
                                </form>
                            </div>
                            <p class="text-center"><a class="nav-link" href="https://tratoragro.com.br/">Tratoragro</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                             <p class="text-center"> © <?php echo date('Y'); ?> Copyright </p>
                        </div>
        </div>

    </div>

</div>

</body>

</html>