<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Emails_produtos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'E-mails recebidos',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
        
            'emails' => $this->core_model->get_all('formulario_produto'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('emails_produtos/index');
        $this->load->view('layout/footer');

    }

    
    public function deletar($email_id = null){
        if(!$email_id || !$this->core_model->get_by_id('formulario_produto', array('id' => $email_id))){
            $this->session->set_flashdata('error', 'E-mail não enontrado!');
            redirect('emails_produtos');
        }else{
            // deletar
            $this->core_model->delete('formulario_produto', array('id' => $email_id));
            redirect('emails_produtos');
        }
    }
}