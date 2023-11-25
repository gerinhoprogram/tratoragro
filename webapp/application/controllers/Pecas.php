<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Pecas extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
        $this->load->model('pecas_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Cadastro de peçcas',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            'pecas' => $this->pecas_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('pecas/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('peca_nome', 'Nome da peça', 'trim|required|min_length[2]|max_length[145]|is_unique[cadastro_pecas.peca_nome]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'peca_nome',
                        'peca_url',
                        'peca_status',
                        'peca_descricao',
                        'peca_marca',
                        'peca_foto'
                    ), $this->input->post()
                    );

                $data['peca_url'] = $this->geradorTags($this->input->post('peca_nome'));
                $data['peca_foto'] = $this->input->post('peca_foto_troca');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('cadastro_pecas', $data);

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Adicionar nova peça',

                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/autocomplete/jquery-ui.js',
                        'js/pecas.js',
                        'js/util.js'
                    ),

                    'marcas' => $this->core_model->get_all('cadastro_marcas'),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('pecas/add');
                $this->load->view('layout/footer');
            }
    }

    
    public function upload_file(){

        // echo"<pre>";
        // print_r('upload');
        // exit();

        $config['upload_path']          = './uploads/pecas/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 1500;
        $config['max_width']            = 600;
        $config['max_height']           = 600;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('peca_foto')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'peca_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );

            //criando copia da imagem em tamanho menor

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/pecas/'.$this->upload->data('file_name');
            $config['new_image'] = './uploads/pecas/small/'.$this->upload->data('file_name');
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

    public function editar($peca_id = null){

        if(!$peca_id || !$this->core_model->get_by_id('cadastro_pecas', array('peca_id' => $peca_id))){

            $this->session->set_flashdata('error', 'Peça não encontrado');
            redirect('pecas');

        }else{

            $this->form_validation->set_rules('peca_nome', 'Nome da peça', 'trim|required|min_length[2]|max_length[145]|callback_check_peca_nome');

            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'peca_nome',
                        'peca_url',
                        'peca_status',
                        'peca_descricao',
                        'peca_marca',
                        'peca_foto'
                    ), $this->input->post()
                    );
                    $data['peca_url'] = $this->geradorTags($this->input->post('peca_nome'));
                    $data['peca_foto'] = $this->input->post('peca_foto_troca');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('cadastro_pecas', $data, array('peca_id' => $peca_id));

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Atualizar peça - '. $peca_id,

                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/autocomplete/jquery-ui.js',
                        'js/pecas.js',
                        'js/util.js'
                    ),
                    'pecas' => $this->core_model->get_by_id('cadastro_pecas', array('peca_id' => $peca_id)),
                    'marcas' => $this->core_model->get_all('cadastro_marcas'),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('pecas/edit');
                $this->load->view('layout/footer');
            }

        }

    }
    
    public function deletar($peca_id = null){
        if(!$peca_id || !$this->core_model->get_by_id('cadastro_pecas', array('peca_id' => $peca_id))){
            $this->session->set_flashdata('error', 'Peça não enontrada!');
            redirect('pecas');
        }

        // deletar
        $this->core_model->delete('cadastro_pecas', array('peca_id' => $peca_id));
        redirect('pecas');
        
    }

    public function check_peca_nome($peca_nome){
        $peca_id = $this->input->post('peca_id');
        if($this->core_model->get_by_id('cadastro_pecas', array('peca_nome' => $peca_nome, 'peca_id !=' => $peca_id))){
                $this->form_validation->set_message('check_peca_nome', 'Esta peça já existe, escolha outro nome!');
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
                
                'pecas' => $this->pecas_model->get_all(),
                'marcas' => $this->core_model->get_all('cadastro_marcas'),
            );
    
            $this->load->view('layout/header', $data);
            $this->load->view('pecas/imprimir');
            $this->load->view('layout/footer');
    
        }

        
    }

    public function pdf_imprimir($filtro){

        $empresa = $this->core_model->get_by_id('sistema', array('id' => 1));

        if(!$filtro['peca_marca']){
            unset($filtro['peca_marca']);
        }
        if($filtro['peca_status'] == ''){
            unset($filtro['peca_status']);
        }

        if(!$pecas = $this->pecas_model->get_filter($filtro)){
            $this->session->set_flashdata('error', 'Não foi encontrado informações referente pesquisa!');
            redirect('pecas/pdf');
        }
    
        $file_name = 'pecas';

        $html = '<html>';

            $html .= '<head>';
            
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de peças</title>';

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
                        $html .= '<th>Marca</th>';
                        $html .= '<th>Status</th>';
                        $html .= '<th>Foto</th>';

                    $html .= '</tr>';

                    $cont = 1;

                    foreach($pecas as $peca){

                        if($cont == 0){
                            $linha = '#fff';
                            $cont = 1;
                        }else{
                            $linha = '#ddd';
                            $cont = 0;
                        }

                        $html .= '<tr style="background: '.$linha.'">';

                            $html .= '<td>'.$peca->peca_id.'</td>';
                            $html .= '<td>'.$peca->peca_nome.'</td>';
                            $html .= '<td>'.$peca->marca_nome.'</td>';
                            $html .= '<td>'.($peca->peca_status == 1 ? 'Ativa' : 'Inativa').'</td>';
                            $html .= '<td>'.($peca->peca_foto ? 'Com foto' : 'Sem foto').'</td>';

                        $html .= '</tr>';
                        $html .= '<tr style="background: '.$linha.'">';
                            $html .= '<td colspan="5"><b>Descrição:</b>&nbsp;'.$peca->peca_descricao.'</td>';
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