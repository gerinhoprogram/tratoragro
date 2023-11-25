<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Emails extends CI_Controller{

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
        
            'emails' => $this->core_model->get_all('envia_formulario'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('emails/index');
        $this->load->view('layout/footer');

    }

    
    public function deletar($emil_id = null){
        if(!$emil_id || !$this->core_model->get_by_id('envia_formulario', array('id' => $emil_id))){
            $this->session->set_flashdata('error', 'E-mail não enontrado!');
            redirect('emails');
        }else{
            // deletar
            $this->core_model->delete('envia_formulario', array('id' => $emil_id));
            redirect('emails');
        }
    }
}