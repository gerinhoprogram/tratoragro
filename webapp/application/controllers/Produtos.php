<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Produtos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
        $this->load->model('produtos_model');
        $this->load->model('aux_categoria_produtos');
    }

    public function index(){

        $data = array(

            'titulo' => 'Produtos cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',

                'vendor/datatables/export/datatables.buttons.min.js',
                'vendor/datatables/export/pdfmake.min.js',
                'vendor/datatables/export/vfs_fonts.js',
                'vendor/datatables/export/buttons.html5.min.js',

                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'produtos' => $this->produtos_model->get_all(),
            'aux_sub' => $this->aux_categoria_produtos->get_all(),
        );

        // echo"<pre>";
        // print_r($data['aux_sub']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

            // echo"<pre>";
            // print_r($this->input->post());
            // exit();

            // $this->form_validation->set_rules('prod_titulo', 'Nome', 'trim|required|min_length[2]|max_length[145]|is_unique[cadastro_produtos.prod_titulo]');
            $this->form_validation->set_rules('prod_titulo', 'Nome', 'trim|required|min_length[2]|max_length[145]');
            $this->form_validation->set_rules('prod_descricao', 'descrição', 'trim|max_length[999999]');
            $this->form_validation->set_rules('prod_modelo', 'Modelo', 'trim|min_length[1]|max_length[145]');
            $this->form_validation->set_rules('prod_tipo', 'Tipo', 'trim|min_length[1]|max_length[100]');
           
            $this->form_validation->set_rules('prod_cat_principal', 'Categoria', 'trim|required|min_length[1]');

            $prod_categoria = $this->input->post('prod_categoria');
            if(!$prod_categoria){
                $this->form_validation->set_rules('prod_categoria', 'Subcategoria', 'trim|required|min_length[1]');
            }

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'prod_titulo',
                        'prod_descricao',
                        'prod_status',
                        'prod_destaque',
                        'prod_marca',
                        'prod_url',
                        'prod_video',
                        'prod_modelo',
                        'prod_tipo',

                    ), $this->input->post()
                );

                $data['prod_url'] = $this->geradorTags($this->input->post('prod_titulo'));
                // $data['prod_imagem'] = $this->input->post('user_foto');

                $data = html_escape($data);

                $this->core_model->insert('cadastro_produtos', $data, true);

                $last_produto_id = $this->session->userdata('last_id');

                //conta quantas fotos tem no array fotos_produtos
                $produto_id = $this->input->post('fotos_produtos');

                if($produto_id){

                       $qty_produto = 0;
                       foreach($produto_id as $prod){
                           $qty_produto ++;
                       }

                   $fotos_produtos = $this->input->post('fotos_produtos');

                   for($i = 0; $i < $qty_produto; $i++){

                       $data = array(
                           'foto_produto_id' => $last_produto_id,
                           'foto_nome' => $fotos_produtos[$i]
                       );

                       $this->core_model->insert('cadastro_produtos_fotos', $data);

                   }
                }
                //    fim de insert fotos

                
                // recebe a categoria principal
                $categoria_id = $this->input->post('prod_cat_principal');

                // array das subcategorias do select multiple
                $subcategorias_id = $this->input->post('prod_categoria');

                if($subcategorias_id){

                    // conta quantas subcategorias existem
                    $qty_subcategorias = 0;
                    foreach($subcategorias_id as $sub){
                        $qty_subcategorias ++;
                    }

                    $prod_categoria = $this->input->post('prod_categoria');

                    for($i = 0; $i < $qty_subcategorias; $i++){

                        $data = array(
                            'cp_produto' => $last_produto_id,
                            'cp_categoria' => $categoria_id,
                            'cp_subcategoria' => $prod_categoria[$i]
                        );

                        $this->core_model->insert('aux_categoria_produtos', $data);

                        }
                }

                $this->index();
               
            }else{
                $data = array(

                    'titulo' => 'Adicionar novo produto',
        
                    //cria array de estilos para passar para view header
                    'styles' => array(
                        'js/jquery-upload-file/css/uploadfile.css', // uploads de arquivos
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
        
                    'scripts' => array(
                        'js/sweetalert2/sweetalert2.all.min.js', //congirma deletar imagem no formulário
                        'js/jquery-upload-file/js/jquery.uploadfile.js', //uploads de arquivos
                        'js/jquery-upload-file/js/produtos.js', //uploads de arquivos
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/autocomplete/jquery-ui.js',
                        'js/usuarios.js',
                        'js/util.js',
                    ),
                   'produtos' => $this->core_model->get_all('cadastro_produtos', array()),
                   'subcategorias' => $this->core_model->get_all('cadastro_subcategorias', array()),
                   'marcas' => $this->core_model->get_all('cadastro_marcas', array()),
                   'categorias' => $this->core_model->get_all('cadastro_categorias', array()),
                );
    
                $this->load->view('layout/header', $data);
                $this->load->view('produtos/add');
                $this->load->view('layout/footer');
            }
    }

    public function upload(){

        $config['upload_path']          = './uploads/produtos/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 2000;
        $config['max_width']            = 1500;
        $config['max_height']           = 1500;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('foto_produto')){
            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(),
                'foto_nome' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );

            //criando copia da imagem em tamanho menor

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/produtos/'.$this->upload->data('file_name');
            $config['new_image'] = './uploads/produtos/small/'.$this->upload->data('file_name');
            $config['width']            = 300;
            $config['height']           = 280;

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

    public function editar($prod_id){

        //  echo"<pre>";
        //         print_r($this->input->post());
        //         exit();

        if(!$prod_id || !$this->core_model->get_by_id('cadastro_produtos', array('prod_id' => $prod_id))){
            $this->session->set_flashdata('error', 'Produto não encontrado');
            redirect ('produtos');
        }else{

            // $this->form_validation->set_rules('prod_titulo', 'Nome', 'trim|required|min_length[2]|max_length[145]|callback_check_prod_titulo');
            $this->form_validation->set_rules('prod_titulo', 'Nome', 'trim|required|min_length[2]|max_length[145]');
            $this->form_validation->set_rules('prod_descricao', 'Descrição', 'trim|max_length[9999]');
            $this->form_validation->set_rules('prod_modelo', 'Modelo', 'trim|min_length[1]|max_length[145]');
            $this->form_validation->set_rules('prod_tipo', 'Tipo', 'trim|min_length[1]|max_length[100]');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'prod_titulo',
                        'prod_descricao',
                        'prod_status',
                        'prod_destaque',
                        'prod_marca',
                        'prod_url',
                        'prod_video',
                        'prod_modelo',
                        'prod_tipo',
                    ), $this->input->post()
                );

                $data['prod_url'] = $this->geradorTags($this->input->post('prod_titulo'));

                //limpa $data
                $data = html_escape($data);

                // deletar imagens antigas para fazer upload
                $this->core_model->delete('cadastro_produtos_fotos', array('foto_produto_id' => $prod_id));

                // atualiza o produto
                $this->core_model->update('cadastro_produtos', $data, array('prod_id' => $prod_id));

                 //conta quantas fotos tem no array fotos_produtos
                 $produto_id = $this->input->post('fotos_produtos');

                 if($produto_id){

                        $qty_produto = 0;
                        foreach($produto_id as $prod){
                            $qty_produto ++;
                        }

                    $fotos_produtos = $this->input->post('fotos_produtos');

                    for($i = 0; $i < $qty_produto; $i++){

                        $data = array(
                            'foto_produto_id' => $prod_id,
                            'foto_nome' => $fotos_produtos[$i],
                            'foto_principal' => ($fotos_produtos[$i] == $this->input->post('foto_principal') ? 1 : 0)
                        );

                        $this->core_model->insert('cadastro_produtos_fotos', $data);

                    }
                }


                // array das subcategorias do select multiple
                $subcategorias_id = $this->input->post('prod_categoria');

                if($subcategorias_id){

                    $this->core_model->delete('aux_categoria_produtos', array('cp_produto' => $prod_id));

                    // recebe a categoria principal
                    $categoria_id = $this->input->post('prod_cat_principal');

                    // conta quantas subcategorias existem
                    $qty_subcategorias = 0;
                    foreach($subcategorias_id as $sub){
                        $qty_subcategorias ++;
                    }

                    $prod_categoria = $this->input->post('prod_categoria');

                    for($i = 0; $i < $qty_subcategorias; $i++){

                        $data = array(
                            'cp_produto' => $prod_id,
                            'cp_categoria' => $categoria_id,
                            'cp_subcategoria' => $prod_categoria[$i]
                        );

                        $this->core_model->insert('aux_categoria_produtos', $data);

                        }
                }

                $this->index();
               
            }else{
                $data = array(

                    'titulo' => 'Editando produto - '. $prod_id,
        
                    //cria array de estilos para passar para view header
                    'styles' => array(
                        'js/jquery-upload-file/css/uploadfile.css', // uploads de arquivos
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
        
                    'scripts' => array(
                        'js/sweetalert2/sweetalert2.all.min.js', //congirma deletar imagem no formulário
                        'js/jquery-upload-file/js/jquery.uploadfile.js', //uploads de arquivos
                        'js/jquery-upload-file/js/produtos.js', //uploads de arquivos
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/autocomplete/jquery-ui.js',
                        'js/usuarios.js',
                        'js/util.js',
                    ),

                    'produto' => $this->core_model->get_by_id('cadastro_produtos', array('prod_id' => $prod_id)),
                    'marcas' => $this->core_model->get_all('cadastro_marcas', array()),
                    'categorias' => $this->core_model->get_all('cadastro_categorias', array()),
                    'subcategorias' => $this->core_model->get_all('cadastro_subcategorias', array()),
                    'produto_fotos' => $this->produtos_model->get_all_fotos($prod_id),
                    'aux_sub' => $this->aux_categoria_produtos->get_all_by_id($prod_id),
                );

                // echo"<pre>";
                // print_r($data['aux_sub']);
                // exit();

    
                $this->load->view('layout/header', $data);
                $this->load->view('produtos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($prod_id = null){

        if(!$prod_id || !$this->core_model->get_by_id('cadastro_produtos', array('prod_id' => $prod_id))){
            $this->session->set_flashdata('eror', 'Produto não encontrado');
            redirect ('produtos');
        }else{
            $this->core_model->delete('cadastro_produtos', array('prod_id' => $prod_id));
            redirect ('produtos');
        }
    }

    public function check_prod_titulo($prod_titulo){
        $prod_id = $this->input->post('prod_id');
        if($this->core_model->get_by_id('cadastro_produtos', array('prod_titulo' => $prod_titulo, 'prod_id !=' => $prod_id))){
                $this->form_validation->set_message('check_prod_titulo', 'Este produto já existe, escolha outro nome!');
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
                'categorias' => $this->core_model->get_all('cadastro_categorias'),
                'subcategorias' => $this->core_model->get_all('cadastro_subcategorias'),
            );
    
            $this->load->view('layout/header', $data);
            $this->load->view('produtos/imprimir');
            $this->load->view('layout/footer');
    
        }

        
    }

    public function pdf_imprimir($filtro){
     
        $empresa = $this->core_model->get_by_id('sistema', array('id' => 1));

        if($filtro['prod_status'] == ''){
            unset($filtro['prod_status']);
        }
        if($filtro['prod_destaque'] == ''){
            unset($filtro['prod_destaque']);
        }
        if($filtro['prod_marca'] == ''){
            unset($filtro['prod_marca']);
        }
        if($filtro['cp_categoria'] == ''){
            unset($filtro['cp_categoria']);
        }
        if($filtro['cp_subcategoria'] == ''){
            unset($filtro['cp_subcategoria']);
        }

        if(!$produtos = $this->produtos_model->get_filter($filtro)){
            $this->session->set_flashdata('error', 'Não foi encontrado informações referente pesquisa!');
            redirect('produtos/pdf');
        }

        // echo"<pre>";
        // print_r($produtos);
        // exit;

        // $produtos = $this->produtos_model->get_all();
        $aux_sub = $this->aux_categoria_produtos->get_all();
        
        $file_name = 'produtos';

        $html = '<html>';

            $html .= '<head>';
            
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de produtos</title>';

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
                        $html .= '<th>Categoria</th>';
                        $html .= '<th>Subcategoria</th>';
                        $html .= '<th>Marca</th>';
                        $html .= '<th>Modelo</th>';
                        $html .= '<th>Status</th>';
                        $html .= '<th>Destaque</th>';

                    $html .= '</tr>';

                    $cont=1;

                    foreach($produtos as $produto){

                        if($cont == 0){
                            $linha = '#fff';
                            $cont = 1;
                        }else{
                            $linha = '#ddd';
                            $cont = 0;
                        }

                        $html .= '<tr style="background: '.$linha.'">';

                            $html .= '<td>'.$produto->prod_id.'</td>';
                            $html .= '<td>'.$produto->prod_titulo.'</td>';
                            $html .= '<td>'.$produto->cat_titulo.'</td>';
                            $html .= '<td>';
                            foreach($aux_sub as $sub){
                                if($sub->cp_produto == $produto->prod_id){
                                    $html .= $sub->scat_titulo.'<br>';
                                }
                            }
                            $html .= '</td>';
                            $html .= '<td>'.$produto->marca_nome.'</td>';
                            $html .= '<td>'.$produto->prod_modelo.'</td>';
                            $html .= '<td>'.($produto->prod_status == 1 ? 'Ativo' : 'Inativo').'</td>';
                            $html .= '<td>'.($produto->prod_destaque == 1 ? 'Sim' : 'Não').'</td>';

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