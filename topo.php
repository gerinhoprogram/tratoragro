<div class="topo">
    <div class="faixa">
        <div id="faixa">
        
            <span class='link_blog'> <a href="blog/"><i class="far fa-newspaper"></i> Blog </a></span>
            <?php
                if($_SESSION['aluno_id'] == ''){
                    echo'
                        <div class="cadastre">
                            <a href="cadastre-se/"><div class="bloco" alt="Cadastre-se" title="Cadastre-se">
                                <i class="fas fa-user-plus" alt="Cadastre-se" title="Cadastre-se"></i> <span>Cadastre-se</span>
                            </div></a>
                            <a href="login/"><div class="bloco" alt="Login" title="Login">
                                <i class="fas fa-sign-in-alt"  alt="Login" title="Login"></i> <span>Fazer Login </span>
                            </div></a>
                        </div>    
                    '; 
                }
                else {
                    echo'
                        <div class="cadastre">
                            <a href="index/true"><div class="bloco" alt="Meus Cursos" title="Meus Cursos">
                                <i class="fas fa-sign-out-alt" alt="Sair" title="Sair"></i> <span>Sair</span>
                            </div></a>

                            <a href="meu-perfil/"><div class="bloco" alt="Meu Perfil" title="Meu Perfil">
                                <i class="far fa-user-circle" alt="Meu Perfil" title="Meu Perfil"></i> <span>Meu Perfil</span>
                            </div></a>

                            <a href="meus-cursos/"><div class="bloco" alt="Meus Cursos" title="Meus Cursos">
                                <i class="fas fa-book" alt="Meus Cursos" title="Meus Cursos"></i> <span>Meus Cursos </span>
                            </div></a>

                        </div>    
                    '; 
                }    
            ?>
        </div>
        <div class='menu' id='menu_resp'>
            <?php include("core/mod_menu/menu_site.php");  ?>   
        </div>

    </div>
    <div id='topo'>
        <div class='logo'>
            <a href='index/'><img src='core/imagens/site/logo.png' alt="Hub da Beleza" class='logo_c'></a>
        </div>   
        <div class="busca">
            <form name='form_busca' id='form_busca' enctype='multipart/form-data' method='post' action='busca/'>
                <input type='text' autofocus required name="busca" id="busca" placeholder="O que deseja aprender?"> <button type="submit" value='Pesquisar'><i class="fa fa-search"></i></button>
            </form>
        </div>
        
        <div class='menu'>
            <?php include("core/mod_menu/menu_site.php");  ?>   
        </div>
        
    </div>
</div>
