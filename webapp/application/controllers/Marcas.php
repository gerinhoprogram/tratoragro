<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Marcas extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'Marcas cadastradas',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'marcas' => $this->core_model->get_all('cadastro_marcas'),
        );

        // echo"<pre>";
        // print_r($data);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('marca_nome', 'Nome da marca', 'trim|required|min_length[2]|max_length[145]|is_unique[cadastro_marcas.marca_nome]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'marca_nome',
                        'marca_nome',
                        'marca_email',
                        'marca_telefone',
                        'marca_url',
                        'marca_foto',
                        'marca_status',
                        'marca_destaque'
                    ), $this->input->post()
                    );

                    $data['marca_url'] = $this->geradorTags($this->input->post('marca_nome'));
                    $data['marca_foto'] = $this->input->post('marca_foto_troca');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('cadastro_marcas', $data);

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Adicionar Marca',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'js/marcas.js',
                        'js/util.js',
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/add');
                $this->load->view('layout/footer');
            }
    }

    public function editar($marca_id = null){

        if(!$marca_id || !$this->core_model->get_by_id('cadastro_marcas', array('marca_id' => $marca_id))){

            $this->session->set_flashdata('error', 'Marca não encontrada');
            redirect('marcas');

        }else{

                $this->form_validation->set_rules('marca_nome', 'Nome da marca', 'trim|required|min_length[2]|max_length[145]|callback_check_marca_nome');

                if($this->form_validation->run()){
                // if($this->input->post()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'marca_nome',
                        'marca_email',
                        'marca_telefone',
                        'marca_url',
                        'marca_foto',
                        'marca_status',
                        'marca_destaque'
                    ), $this->input->post()
                    );

                    $data['marca_url'] = $this->geradorTags($this->input->post('marca_nome'));
                    $data['marca_foto'] = $this->input->post('marca_foto_troca');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('cadastro_marcas', $data, array('marca_id' => $marca_id));

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Atualizar Marca - '. $marca_id,
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'js/marcas.js',
                        'js/util.js',
                    ),
                    'marca' => $this->core_model->get_by_id('cadastro_marcas', array('marca_id' => $marca_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function upload_file(){

        $config['upload_path']          = './uploads/marcas/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 1500;
        $config['max_width']            = 600;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('marca_foto')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'marca_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );

            //criando copia da imagem em tamanho menor

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/marcas/'.$this->upload->data('file_name');
            $config['new_image'] = './uploads/marcas/small/'.$this->upload->data('file_name');
            $config['width']            = 200;
            $config['height']           = 200;

            $this->load->library('image_lib', $config);

            if(!$this->image_lib->resize()){

                $data['erro'] = 3;
                $data['mensagem'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');

            }
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }

    public function geradorTags($valor){
        $array1 = array(
            "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç",
            "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç",
            "/", "- ", ",", "%", "?", "&", "º", "ª", "|", "'", "(", ")", ":", "´", '"', ".", '”', "!", "*", "`", "+", "--", "[","]", "{","}", " ", "  ","¨","#", "=", "$","_"
        );

        $array2 = array(
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c",
            "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C",
            "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "","","","","-","-", "", "","","",""
        );

        $tags = str_replace($array1, $array2, $valor);
        $tags = strtolower($tags);
        $tags = str_replace('--', '-', $tags);
        return $tags;
    }

    
    public function deletar($marca_id = null){
        if(!$marca_id || !$this->core_model->get_by_id('cadastro_marcas', array('marca_id' => $marca_id))){
            $this->session->set_flashdata('error', 'Marca não enontrado!');
            redirect('marcas');
        }

        if($this->db->table_exists('cadastro_produtos')){

            if($this->core_model->get_by_id('cadastro_produtos', array('prod_marca' => $marca_id))){
                    $this->session->set_flashdata('error', 'Esta marca não pode ser excluida esta sendo utilizada em Produtos!');
                    redirect ('marcas');
            }

        }

        // deletar
        $this->core_model->delete('cadastro_marcas', array('marca_id' => $marca_id));
        redirect('marcas');
        
    }

    
    public function check_marca_nome($marca_nome){
        $marca_id = $this->input->post('marca_id');
        if($this->core_model->get_by_id('cadastro_marcas', array('marca_nome' => $marca_nome, 'marca_id !=' => $marca_id))){
                $this->form_validation->set_message('check_marca_nome', 'Esta marca já existe, escolha outro nome!');
                return false;
        }else{
            return true;
        }
    }

    public function pdf(){

        $filtro = array();
        $filtro = $this->input->post();

        if($filtro){

            $this->pdf_imprimir($filtro);

        }else{
            $data = array(

                'titulo' => 'Filtro para gerar PDF',
    
                //cria array de estilos para passar para view header
                'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                ),
    
                'scripts' => array(
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/autocomplete/jquery-ui.js',
                ),

                'marcas' => $this->core_model->get_all('cadastro_marcas'),
            );
    
            $this->load->view('layout/header', $data);
            $this->load->view('marcas/imprimir');
            $this->load->view('layout/footer');
    
        }

        
    }

    public function pdf_imprimir($filtro){
     
                $empresa = $this->core_model->get_by_id('sistema', array('id' => 1));

                if($filtro['marca_status'] == ''){
                    unset($filtro['marca_status']);
                }
                if($filtro['marca_destaque'] == ''){
                    unset($filtro['marca_destaque']);
                }
        
                if(!$marcas = $this->core_model->get_filter($filtro)){
                    $this->session->set_flashdata('error', 'Não foi encontrado informações referente pesquisa!');
                    redirect('marcas/pdf');
                }
                
                $file_name = 'Marcas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de marcas</title>';

                    $html .= '</head>';

                    $html .= '<body style="font-size: 12px">';

                        $html .= 
                                '<h4 align="center">'.
                                $empresa->sistema_razao_social. '<br>'.
                                $empresa->sistema_cnpj. '<br>'.
                                $empresa->sistema_endereco. '&nbsp;'.$empresa->sistema_numero.'<br>'.
                                $empresa->sistema_cidade.'/'.$empresa->sistema_estado.
                                '</h4>';

                        $html .= '<hr>';
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Id</th>';
                                $html .= '<th>Nome</th>';
                                $html .= '<th>Telefone</th>';
                                $html .= '<th>E-mail</th>';
                                $html .= '<th>Destaque</th>';
                                $html .= '<th>Status</th>';
                                $html .= '<th>Foto</th>';

                            $html .= '</tr>';

                            $cont = 1;

                            foreach($marcas as $marca){

                                if($cont == 0){
                                    $linha = '#fff';
                                    $cont = 1;
                                }else{
                                    $linha = '#ddd';
                                    $cont = 0;
                                }

                                $html .= '<tr style="background: '.$linha.'">';

                                    $html .= '<td>'.$marca->marca_id.'</td>';
                                    $html .= '<td>'.$marca->marca_nome.'</td>';
                                    $html .= '<td>'.$marca->marca_telefone.'</td>';
                                    $html .= '<td>'.$marca->marca_email.'</td>';
                                    $html .= '<td>'.($marca->marca_destaque == 1 ? 'Sim' : 'Não').'</td>';
                                    $html .= '<td>'.($marca->marca_status == 1 ? 'Ativa' : 'Inativa').'</td>';
                                    $html .= '<td>'.($marca->marca_foto ? 'Com foto' : 'Sem foto').'</td>';

                                $html .= '</tr>';

                            }

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

        
    }


}