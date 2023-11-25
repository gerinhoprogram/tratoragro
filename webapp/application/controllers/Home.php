<?php
defined('BASEPATH') OR exit('Acesso não permitido');

class Home extends CI_controller{
	public function __construct(){
		parent::__construct();

			if(!$this->ion_auth->logged_in()){
				$this->session->set_flashdata('info', 'Sua sessão expirou!');
				redirect ('login');
			}

			$this->load->model('home_model');
	}
	
	public function index(){

		$data = array(
			'titulo' => 'Home',
			'cont_marcas' => $this->home_model->get_cont_marcas(),
			'cont_categorias' => $this->home_model->get_cont_categorias(),
			'cont_subcategorias' => $this->home_model->get_cont_subcategorias(),
			'cont_produtos' => $this->home_model->get_cont_produtos(),
			'cont_pecas' => $this->home_model->get_cont_pecas(),
		);

		$contador_notificacao = 0;

		if($this->home_model->get_emails_recebidos()){

			$data ['emails_recebidos'] = true;
			$contador_notificacao ++;

		}else{
			$data ['emails_recebidos'] = false;
		}

		if($this->home_model->get_emails_produtos()){

			$data ['emails_produtos'] = true;
			$contador_notificacao ++;

		}else{
			$data ['emails_produtos'] = false;
		}

		$data ['contador_notificacao'] = $contador_notificacao;

		$this->load->view('layout/header', $data);
		$this->load->view('home/index');
		$this->load->view('layout/footer');
	}
}