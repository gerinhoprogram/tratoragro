<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller{

    public function __construct(){
		parent::__construct();

        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect ('login');
        }
	}

    public function index(){

        if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info', 'Usuário não tem permissão ao módulo usuários');
            redirect('home');
        }

        $data = array(

            'titulo' => 'Usuário cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela usuarios
            'usuarios' => $this->ion_auth->users()->result(),
        );

        // echo"<pre>";
        // print_r($data['usuarios']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function adicionar(){

        if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info', 'Usuário não tem permissão ao módulo usuários');
            redirect('home');
        }

            //validação do formulário
            //matches verifica se um campo é igual ao outro
            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirma', 'matches[password]');

        if($this->form_validation->run()){

            //grava no banco
            //security->xss_clean limpa o input de códigos
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));

            $additional_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'username' => $this->input->post('username'),
                        'last_name' => $this->input->post('last_name'),
                        'active' => $this->input->post('active')
                        );

            $group = array($this->input->post('perfil_usuario'));

            $additional_data = $this->security->xss_clean($additional_data);
            $group = $this->security->xss_clean($group);
        
            //envia os dados para gravar no banco
            //comentar linha 852 do arquivo Ion_auth_model.php
            if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){

                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');

            }else{

                $this->session->set_flashdata('error', 'Erro ao salvar os dados');

            }

            $this->index();
            

        }else{
            
            $data = array(
                'titulo' => 'cadastrar usuário'
            );

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/add');
            $this->load->view('layout/footer');
        }

    }

    

    //função de editar usuario
    public function editar($usuario_id = null){

        $user_session = $this->session->userdata('user_id');

        if(!$this->ion_auth->is_admin()){
            if($user_session != $usuario_id){
                $this->session->set_flashdata('info', 'Não pode editar um usuário diferente do seu!');
                redirect('home');
            }
        }

        if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){

            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');

        }else{

            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirma', 'matches[password]');

            if($this->form_validation->run()){

                // variavel $data armazena um array com todos os dados
                //dos inputs
                $data = elements(

                    array(
                        'first_name',
                        'last_name',
                        'email',
                        'username',
                        'active',
                        'password',

                    ),$this->input->post()

                );

                //limpa código javascript nos inputs
                $data = $this->security->xss_clean($data);

                if(!$this->ion_auth->is_admin()){
                    unset($data['active']);
                }
               
                $password = $this->input->post('password');

                //retira do array $data o campo senha se estiver em branco
                if(!$password){
                    unset($data['password']);
                }

                //utilizando o plugin para atualizar os dados da tabela users $data são os dados
                //e um array com as condições
                if($this->ion_auth->update($usuario_id, $data)){

                    //peega na tabela o perfil atual
                    $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();

                    //pega o perfil vindo do post
                    $perfil_usuario_post = $this->input->post('perfil_usuario');

                    if($this->ion_auth->is_admin()){
                        //se for diferente autaliza o grupo
                        if($perfil_usuario_post != $perfil_usuario_db->id){
                            $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
                            $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
                        }
                    }

                    $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
                }else{
                    $this->session->set_flashdata('error', 'Erro ao salvar dados');
                }

                if($this->ion_auth->is_admin()){
                    $this->index();
                }else{
                    $this->session->set_flashdata('success', 'Dados salvos com sucesso');
                    redirect('home');
                }

                

            }else{

                $data = array(
                    'titulo' => 'Editar usuário',
    
                    //chave traz todos os dados do banco de usuario
                    'usuario' => $this->ion_auth->user($usuario_id)->row(),
                    'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row()
                );
    
                $this->load->view('layout/header', $data);
    
                //carrega a view desta função
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');

            }
        }
    }

    // função call back de edit
    public function email_check($email){

        $usuario_id = $this->input->post('usuario_id');

        if($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))){

            $this->form_validation->set_message('email_check', 'Esse email já existe');
            return false;

        }else{
            return true;
        }

    }

    // função call back de edit
    public function username_check($username){

        $usuario_id = $this->input->post('usuario_id');

        if($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))){

            $this->form_validation->set_message('username_check', 'Esse usuário já existe');
            return false;

        }else{
            return true;
        }

    }

    //deletar
    public function deletar($usuario_id = null){

        if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info', 'Usuário não tem permissão ao módulo usuários');
            redirect('home');
        }

        //verifica se foi passado um usuário
        if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){

            $this->session->set_flashdata('error', 'Usuário não encontrado!');
            redirect ('usuarios');

        }
        
        if($this->ion_auth->is_admin($usuario_id)){

                $this->session->set_flashdata('error', 'Admninistrador não pode ser excluido!');
                redirect ('usuarios');

        }

        if($this->ion_auth->delete_user($usuario_id)){

            $this->session->set_flashdata('sucesso', 'Usuário excluido com sucesso!');
            redirect ('usuarios');

        }else{
            $this->session->set_flashdata('error', 'Usuário não excluido!');
            redirect ('usuarios');
        }
    
    }
}