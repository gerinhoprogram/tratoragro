<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->session->set_flashdata('info', 'Usuário não tem permissão de acesso!');
            redirect ('home');
        }

        $this->load->model('core_model');
    }

    public function index(){

        //pega na tabela sistema os dados
        $data = array(
            'titulo' => 'Dados da empresa',
            'sistema' => $this->core_model->get_by_id('sistema', array('id' => 1)),
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js'
            ),
        );

            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
    }

    

public function editar($sistema_id){

    if(!$sistema_id || !$this->core_model->get_by_id('sistema', array('id' => $sistema_id))){
        $this->session->set_flashdata('error', 'Sistema não encontrado');
        redirect ('sistema');
    }else{

            $this->form_validation->set_rules('sistema_razao_social', 'Razão Social', 'trim|required|min_length[5]|max_length[140]');
            $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome Fantasia', 'trim|required|min_length[5]|max_length[140]');
            $this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|required|valid_email|max_length[100]');

            $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_whatsap', 'Whatsap', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_whatsap_segunda_opcao', 'Whatsap', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_fax', 'Fax', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_telefone_segunda_opcao', 'Telefone', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_telefone_terceira_opcao', 'Telefone', 'trim|max_length[18]');
            $this->form_validation->set_rules('sistema_telefone_quarta_opcao', 'Telefone', 'trim|max_length[18]');

            $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|exact_length[9]');
            $this->form_validation->set_rules('sistema_endereco', '', 'trim|max_length[200]');
            $this->form_validation->set_rules('sistema_numero', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('sistema_estado', '', 'trim|exact_length[2]');
            $this->form_validation->set_rules('sistema_cidade', '', 'trim|max_length[100]');

            $this->form_validation->set_rules('sistema_site_url', 'URL site', 'trim|valid_url|max_length[200]');
            $this->form_validation->set_rules('sistema_facebook', 'Link Facebook', 'trim|max_length[300]');
            $this->form_validation->set_rules('sistema_instagram', 'Link Instagram', 'trim|max_length[300]');
            $this->form_validation->set_rules('sistema_linkedin', 'Link Linkedin', 'trim|max_length[300]');
            $this->form_validation->set_rules('sistema_you_tube', 'You Tube', 'trim|max_length[300]');

            if($this->form_validation->run()){

                //captura os dados para gravar no banco
                $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_telefone_fixo',
                        'sistema_telefone_segunda_opcao',
                        'sistema_telefone_terceira_opcao',
                        'sistema_telefone_quarta_opcao',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_cep',
                        'sistema_endereco',
                        'sistema_numero',
                        'sistema_estado',
                        'sistema_cidade',
                        'sistema_descricao',
                        'sistema_facebook',
                        'sistema_linkedin',
                        'sistema_instagram',
                        'sistema_fax',
                        'sistema_whatsap',
                        'sistema_whatsap_segunda_opcao',
                        'sistema_youtube',
                        
                    ), $this->input->post()
                );

                //limpa codigo js dos inputs
                //precisa colocar como TRUE em config.php $config['global_xss_filtering'] = TRUE;
                $data = html_escape($data);

                //atualiza na tabela sistema com id igual a 1
                $this->core_model->update('sistema', $data, array('id' => 1));

                $this->index();

                }else{

                    //pega na tabela sistema os dados
                    $data = array(
                        'titulo' => 'Dados da empresa',
                        'sistema' => $this->core_model->get_by_id('sistema', array('id' => 1)),
                        'scripts' => array(
                            'vendor/mask/jquery.mask.min.js',
                            'vendor/mask/app.js'
                        ),
                    );

                    $this->load->view('layout/header', $data);
                    $this->load->view('sistema/editar');
                    $this->load->view('layout/footer');

                }

            }
        }
}
