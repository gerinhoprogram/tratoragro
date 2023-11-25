<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_controller{

    public function index(){

        $data = array(
            'titulo' => 'Login'
        );

            $this->load->view('layout/header');
            $this->load->view('login/index');
            $this->load->view('layout/footer'); 

    }

    public function autenticar(){

        $login = $this->security->xss_clean($this->input->post('email'));
        $senha = $this->security->xss_clean($this->input->post('password'));

        if($this->ion_auth->login($login, $senha)){

            redirect ('home');

        }else{

            $this->session->set_flashdata('error', 'E-mail ou senha incorretos!');
            redirect ('login');
            
        }
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect ('login');
    }

}