<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Subcategorias extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        $this->load->model('subcategorias_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Cadastro de subcategorias',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'subcategorias' => $this->subcategorias_model->get_all(),

            // 'produtos' => $this->produtos_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('subcategorias/index');
        $this->load->view('layout/footer');

    }

    public function carregar(){
        $json = $this->input->post();
        $cat_id = $json['id'];

        $result = array();

        $result = $this->core_model->get_all('cadastro_subcategorias', array('scat_categoria' => $cat_id));

        if($result){
            $result['error'] = 0;

        }else{
            $result['error'] = 4;
            $result['msg'] = 'sem cat';
        }

        // echo"<pre>";
        // print_r($result);
        // exit();


        echo json_encode($result);
    }

    public function adicionar(){

            $this->form_validation->set_rules('scat_titulo', 'Nome', 'trim|required|min_length[2]|max_length[145]');
           
            if($this->form_validation->run()){

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'scat_titulo',
                        'scat_url',
                        'scat_categoria',
                        'scat_destaque',
                        'scat_status',
                    ), $this->input->post()
                    );

                $data['scat_url'] = $this->geradorTags($this->input->post('scat_titulo'));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->insert('cadastro_subcategorias', $data);

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Adicionar nova subcategoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),

                    'categorias' => $this->core_model->get_all('cadastro_categorias'),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('subcategorias/add');
                $this->load->view('layout/footer');
            }
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

    public function editar($scat_id = null){

        if(!$scat_id || !$this->core_model->get_by_id('cadastro_subcategorias', array('scat_id' => $scat_id))){

            $this->session->set_flashdata('error', 'categoria não encontrado');
            redirect('subcategorias');

        }else{

            $this->form_validation->set_rules('scat_titulo', '', 'trim|required|min_length[5]|max_length[145]');

            if($this->form_validation->run()){

                // $categoria_ativa = $this->input->post('categoria_ativa');

                // if($this->db->table_exists('produtos')){

                //     if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_scat_id' => $scat_id, 'produto_ativo' => 1))){
                //             $this->session->set_flashdata('error', 'Esta categoria não pode ser desativada esta sendo utilizada em Produtos');
                //             redirect ('subcategorias');
                //     }

                // }

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'scat_titulo',
                        'scat_url',
                        'scat_categoria',
                        'scat_destaque',
                        'scat_status'
                    ), $this->input->post()
                    );

                    $data['scat_url'] = $this->geradorTags($this->input->post('scat_titulo'));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('cadastro_subcategorias', $data, array('scat_id' => $scat_id));

                $this->index();

            }else{

                $data = array(

                    'titulo' => 'Atualizar subcategoria',
                   
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js'
                    ),
                    'subcategorias' => $this->core_model->get_by_id('cadastro_subcategorias', array('scat_id' => $scat_id)),
                    'categorias' => $this->core_model->get_all('cadastro_categorias', array()),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('subcategorias/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($scat_id = null){
        if(!$scat_id || !$this->core_model->get_by_id('cadastro_subcategorias', array('scat_id' => $scat_id))){
            $this->session->set_flashdata('error', 'categoria não enontrado!');
            redirect('subcategorias');
        }

        if($this->db->table_exists('cadastro_produtos')){

            if($this->subcategorias_model->get_by_id($scat_id)){
                    $this->session->set_flashdata('error', 'Esta subcategoria esta sendo usada em produtos!');
                    redirect ('subcategorias');
            }

        }
            // deletar
            $this->core_model->delete('cadastro_subcategorias', array('scat_id' => $scat_id));
            redirect('subcategorias');
        
    }

    public function pdf(){
     
        $empresa = $this->core_model->get_by_id('sistema', array('id' => 1));

        $subcategorias = $this->subcategorias_model->get_all();
        
        $file_name = 'subcategorias';

        $html = '<html>';

            $html .= '<head>';
            
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de subcategorias</title>';

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
                        $html .= '<th>Categoria pai</th>';
                        $html .= '<th>Destaque</th>';
                        $html .= '<th>Status</th>';

                    $html .= '</tr>';

                    $cont=1;

                    foreach($subcategorias as $subcategoria){

                        if($cont == 0){
                            $linha = '#fff';
                            $cont = 1;
                        }else{
                            $linha = '#ddd';
                            $cont = 0;
                        }

                        $html .= '<tr style="background: '.$linha.'">';

                            $html .= '<td>'.$subcategoria->scat_id.'</td>';
                            $html .= '<td>'.$subcategoria->scat_titulo.'</td>';
                            $html .= '<td>'.$subcategoria->cat_titulo.'</td>';
                            $html .= '<td>'.($subcategoria->scat_destaque == 1 ? 'Sim' : 'Não' ).'</td>';
                            $html .= '<td>'.($subcategoria->scat_status == 1 ? 'Ativo' : 'Inativo' ).'</td>';

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