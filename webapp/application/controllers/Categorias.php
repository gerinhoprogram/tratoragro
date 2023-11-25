<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function index(){

        $data = array(

            'titulo' => 'Cadastro de categorias',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'categorias' => $this->core_model->get_all('cadastro_categorias'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            $this->form_validation->set_rules('cat_titulo', 'Nome', 'trim|required|min_length[5]|max_length[145]|is_unique[cadastro_categorias.cat_titulo]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'cat_titulo',
                        'cat_url',
                        'cat_destaque',
                        'cat_imagem'
                    ), $this->input->post()
                    );

                $data['cat_url'] = $this->geradorTags($this->input->post('cat_titulo'));
                $data['cat_imagem'] = $this->input->post('cat_foto');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('cadastro_categorias', $data);

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Adicionar nova categoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'js/categorias.js',
                        'js/util.js'
                    ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/add');
                $this->load->view('layout/footer');
            }
    }

    
    public function upload_file(){

        // echo"<pre>";
        // print_r('upload');
        // exit();

        $config['upload_path']          = './uploads/categorias/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 700;
        $config['max_width']            = 300;
        $config['max_height']           = 450;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('cat_imagem')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'cat_foto' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );

            //criando copia da imagem em tamanho menor

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/categorias/'.$this->upload->data('file_name');
            $config['new_image'] = './uploads/categorias/small/'.$this->upload->data('file_name');
            $config['width']            = 100;
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

    public function editar($cat_id = null){

        if(!$cat_id || !$this->core_model->get_by_id('cadastro_categorias', array('cat_id' => $cat_id))){

            $this->session->set_flashdata('error', 'categoria não encontrado');
            redirect('categorias');

        }else{

            $this->form_validation->set_rules('cat_titulo', 'Nome', 'trim|required|min_length[5]|max_length[145]|callback_check_cat_nome');

            if($this->form_validation->run()){

                // $categoria_ativa = $this->input->post('categoria_ativa');

                // if($this->db->table_exists('produtos')){

                //     if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_cat_id' => $cat_id, 'produto_ativo' => 1))){
                //             $this->session->set_flashdata('error', 'Esta categoria não pode ser desativada esta sendo utilizada em Produtos');
                //             redirect ('categorias');
                //     }

                // }

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'cat_titulo',
                        'cat_destaque',
                        'cat_imagem'
                    ), $this->input->post()
                    );
                    $data['cat_url'] = $this->geradorTags($this->input->post('cat_titulo'));
                    $data['cat_imagem'] = $this->input->post('cat_foto');

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('cadastro_categorias', $data, array('cat_id' => $cat_id));

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Atualizar categoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'js/categorias.js',
                        'js/util.js'
                    ),
                    'categoria' => $this->core_model->get_by_id('cadastro_categorias', array('cat_id' => $cat_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($cat_id = null){
        if(!$cat_id || !$this->core_model->get_by_id('cadastro_categorias', array('cat_id' => $cat_id))){
            $this->session->set_flashdata('error', 'Categoria não enontrada!');
            redirect('categorias');
        }

        if($this->db->table_exists('cadastro_produtos')){

            if($this->core_model->get_by_id('cadastro_produtos', array('prod_cat_principal' => $cat_id))){
                    $this->session->set_flashdata('error', 'Esta categoria não pode ser excluida, esta sendo utilizada em Produtos!');
                    redirect ('categorias');
            }

        }

        // deletar
        $this->core_model->delete('cadastro_categorias', array('cat_id' => $cat_id));
        redirect('categorias');
        
    }

    
    public function check_cat_nome($cat_titulo){
        $cat_id = $this->input->post('cat_id');
        if($this->core_model->get_by_id('cadastro_categorias', array('cat_titulo' => $cat_titulo, 'cat_id !=' => $cat_id))){
                $this->form_validation->set_message('check_cat_nome', 'Esta categoria já existe, escolha outro nome!');
                return false;
        }else{
            return true;
        }
    }

    public function pdf(){
     
        $empresa = $this->core_model->get_by_id('sistema', array('id' => 1));

        $categorias = $this->core_model->get_all('cadastro_categorias');
        
        $file_name = 'categorias';

        $html = '<html>';

            $html .= '<head>';
            
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de categorias</title>';

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
               
                $html .= '<table width="100%" style="border: solid #fff 1px">';

                    $html .= '<tr>';

                        $html .= '<th>Id</th>';
                        $html .= '<th>Nome</th>';
                        $html .= '<th>Destaque</th>';
                        $html .= '<th>Foto</th>';

                    $html .= '</tr>';

                    $cont=1;

                    foreach($categorias as $categoria){

                        if($cont == 0){
                            $linha = '#fff';
                            $cont = 1;
                        }else{
                            $linha = '#ddd';
                            $cont = 0;
                        }

                        $html .= '<tr style="background: '.$linha.'">';

                            $html .= '<td>'.$categoria->cat_id.'</td>';
                            $html .= '<td>'.$categoria->cat_titulo.'</td>';
                            $html .= '<td>'.($categoria->cat_destaque == 1 ? 'Sim' : 'Não' ).'</td>';
                            $html .= '<td>'.($categoria->cat_imagem ? 'Com foto' : 'Sem foto' ).'</td>';

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