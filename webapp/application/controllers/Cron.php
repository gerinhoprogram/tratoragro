<?php if(! defined('BASEPATH')) die();

    use BackupManager\Filesystems\Destination;
    use BackupManager\Config\Config;
    use BackupManager\Filesystems;
    use BackupManager\Databases;
    use BackupManager\Compressors;
    use BackupManager\Manager;
    use NFePHP\Extras\Damdfe;

    /**
     * @property dist_pedido_m $dist_pedido_m
     * @property dist_pedido_item_m $dist_pedido_item_m
     * @property usuario_meta_m $usuario_meta_m
     * @property NFE_Gerador $nfe_gerador
     */

    class Cron extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->load->model('lancamento_m');
            $this->load->model('nfe_entrada_m');

        }

        public function usuario_meta($ref = null){


            $this->load->model(['usuario_meta_m']);
            $this->usuario_meta_m->update_usuario_meta('F', $ref);
            //$this->usuario_meta_m->update_usuario_meta('D', $ref);

        }


        public function gera_lancamento_nfe_entrada(){

            $this->load->model('lancamento_m');
            $this->load->model('nfe_entrada_m');
            $this->load->model('empresa_m');
            $data_busca = date('Y-m-d', strtotime("-3 days"));

            $sql = "SELECT id FROM nfe_entrada
                    WHERE nfe_entrada.ide_dhEmi  >= '{$data_busca}'
                    ORDER BY nfe_entrada.ide_dhEmi ";

            $CI =& get_instance();
            $result = $CI->db->query($sql)->result();

            foreach ($result as $index => $item) {
                $lancamento = $this->lancamento_m->get_by([
                    'nfe_entrada_id' => $item->id
                ]);

                 // rogerio ** variavel recebe o id da nfEntrada
                 $id_nf_entrada = $item->id;
 
                 $sql_2 = "SELECT * FROM fin_lancamento
                     WHERE nfe_entrada_id  = $id_nf_entrada";
 
                 $CI =& get_instance();
                 $result_2 = $CI->db->query($sql_2)->result();
 
                 foreach ($result_2 as $row)
                 {
                     $empresa_id = $row->empresa_id;
                 }
 
                 $sql_3 = "SELECT * FROM empresa
                 WHERE id  = $empresa_id";
 
                 $CI =& get_instance();
                 $result_3 = $CI->db->query($sql_3)->result();
 
                 foreach ($result_3 as $row)
                     {   
                         $cliente_gera_caP = $row->dev_gera_caP;
                         $fornecedor_gera_caP = $row->fornecedor_gera_caP;
                     }
                
                 // pega cfop
                 $nfe_itens = "SELECT * FROM nfe_itens
                 WHERE nfe_id  = $id_nf_entrada";
 
                 $CI =& get_instance();
                 $result_nfe_itens = $CI->db->query($nfe_itens)->result();
 
                 foreach ($result_nfe_itens as $row)
                     {   
                         $cfop = $row->CFOP;
                     }
                // fim rogerio

                if($lancamento != ''){

                        // rogerio ** se for qualquer coisa diferente de N gera conta a pagar
                        // 5920 5925 5152 5915
                        if($cliente_gera_caP != "N" && $fornecedor_gera_caP != "N"){
                                if($cfop != 5120 
                                && $cfop != 5556 
                                && $cfop != 5901 
                                && $cfop != 5924 
                                && $cfop != 5934 
                                && $cfop != 5916
                                && $cfop != 5920
                                && $cfop != 5925
                                && $cfop != 5152
                                && $cfop != 5915){

                                     $this->nfe_entrada_m->cria_lancamento_cpagar($item->id);
                           
                            }
                        }
                      
                }
            }

        }

        // public function teste(){
        //     $id = 256513;
        //     $this->lancamento_m->gera_from_nfe($id);
        // }


        public function gerar_boleto(){
            $this->load->library('nfe/NFE_boleto');
            //1441
            $nfe_id = 286593;
            $empresa_id = 8890;
            $cliente_id = 152;
            $this->nfe_boleto->gerar($nfe_id, $empresa_id, $cliente_id);
        }
       

        public function processamento_geral(){
            $this->proc_a();
            $this->proc_b();
            $this->proc_c();
        }

        //Baixa os dados pro sefaz na tabela manifesto_requisicao. (um xml com varios manifestos)
        public function proc_a(){
            $this->load->library('nfe/NFE_sefaz');
            $this->nfe_sefaz->baixa_lotes_sefaz();
        }

        public function proc_b(){

            $this->load->library('nfe/NFE_sefaz');

            $this->nfe_sefaz->processa_lotes_baixados();


        }

        public function proc_c(){

            $this->load->library('nfe/NFE_sefaz');

            $this->nfe_sefaz->salva_xml_manifesto();


        }



        public function proc_salva_xml($manifesto_id = 0){

            if($manifesto_id > 0){
                $this->load->library('nfe/NFE_sefaz');
                $this->nfe_sefaz->salva_xml_manifesto_manifesto_id($manifesto_id);
            }

        }


        public function processa_xml_nao_baixados()
        {
            $qry = "SELECT id FROM manifestos
                    WHERE manifestos.chNFe NOT IN (SELECT chave FROM nfe_entrada WHERE chave IS NOT NULL) 
                    AND digVal <> '' AND dhEmi >= '2019-03-01 00:00:00'
                    ORDER BY dhEmi desc
                    LIMIT 200";

            $result = $this->db->query($qry)->result();


            foreach ($result as $index => $item) {

                $this->proc_salva_xml($item->id);

            }

        }


        /*-----------------------------------*/


        public function processa_manifesto_empresa($empresa_id){



            $this->load->library('nfe/NFE_sefaz');

            log_message("debug","[A][NFE-ENTRADA][INICIO]");
            $this->nfe_sefaz->setar_emissor($empresa_id);

            $tipo_operacao = '210210'; //ciencia de operacao
            $justificativa = '';
            $xml_retorno = $this->Tools->sefazManifesta('42190502108881000275550010000473951004640321', $tipo_operacao, $justificativa, 1);

            exit;
/*
            $lBusca = true;
            $ii = 0;
            while($lBusca){
                log_message("debug","[B][NFE-ENTRADA][LOOP-INI][ {$empresa_id} ][{$ii}]");
                $result = $this->nfe_sefaz->processa_busca_manifesto($empresa_id);
                log_message("debug","[C][NFE-ENTRADA][LOOP-FIM][ {$empresa_id} ][{$ii}]");
                $ii = $ii+1;
                if($result){
                    if(!$result['continua_busca'] || $ii == 5000){
                        $lBusca = false;
                        break;
                    }
                }
                else{
                    $lBusca = false;
                    log_message("debug","[D][NFE-ENTRADA][ERROR][ {$empresa_id} ][{$ii}]");
                    break;
                }
                sleep(2);

            }


        */

        }


        public function busca_manifesto_by_id($empresa_id, $requisicao_id =0){
            $this->load->model('nfe_entrada_m');
            $this->load->model('empresa_m');

            $this->load->library('nfe/NFE_sefaz');

            log_message("debug","INICIO NFE ENTRADA");

            $result = $this->nfe_sefaz->consulta_nfe_manifestada($empresa_id,$requisicao_id);

            //verifica e baixa os xmls
            $this->manifesto_ajustes($empresa_id);

            print_r($result);exit('Terminado processo de baixa verificação, ciencia e baixa do xml');
        }

        public function operacoes_manifesto($chaveNfe,$empresa_id)
        {
            $this->load->library('nfe/NFE_sefaz');

            $result = [
                'error' => FALSE,
            ];
            $codigo_operacao = '210210'; //ciencia de operacao
            $justificativa = '';
            $result = $this->nfe_sefaz->operacao_nfe_manifestada($chaveNfe, $codigo_operacao,$justificativa,$empresa_id);

            $ddd = print_r($result,true);
            log_message("debug","[RETORNO][OPERACAO][{$ddd }]");

            if($result['cStat_evento'] == 135 ){
                $result = $this->nfe_sefaz->operacao_nfe_manifestada($chaveNfe, $codigo_operacao,$justificativa,$empresa_id);
            }

            $this->output_json($result);
        }

        public function manifesto_ajustes($empresa_id){

            $qry = "select * from manifestos 
                where dhEmi >= '2018-11-28 00:00:00'
                and nota_entrada_importada = 'N'
                and cSitNFe != 2
                and cSitNFe != 3
                and empresa_id = {$empresa_id}";

            $result = $this->db->query($qry)->result();


            foreach ($result as $index => $item) {
                $r = $this->operacoes_manifesto($item->chNFe ,$empresa_id);
                print_r($r);
                print_r("\r\n");
            }


        }

        /*
        public function busca_notas_entrada(){

            $this->load->model(['empresa_m']);
            $this->load->model('nfe_entrada_m');
            $this->load->library('nfe/NFE_sefaz');

            $empresas_grupo = $this->empresa_m->order_by('id')->get_many_by(['empresa_grupo' => 1]);

            $data_inicio = date("Y-m-d H:i:s");

            log_message('error',"[INICIO PROCESSO {$data_inicio }]");



            foreach ($empresas_grupo as $key => $item){

                log_message('error',"[INICIANDO EMPRESA {$item->razao_social}]");
                $result = $this->nfe_sefaz->consulta_nfe_manifestada($item->id);
                //print_r($result);exit;

            }






        }*/

    }
