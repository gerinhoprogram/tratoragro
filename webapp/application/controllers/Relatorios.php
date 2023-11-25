<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Relatorios extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }
    }

    public function vendas(){

        $data = array(
            'titulo' => 'Relatórios de vendas'
        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

        // echo"<pre>";
        // print_r($this->input->post());
        // exit();

        if($data_inicial){

            $this->load->model('vendas_model');

            if($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)){

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $vendas = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);
                
                $file_name = 'Relatório de vendas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de vendas</title>';

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

                        $html .= '<p>Relatório de vendas realizadas na data:</p>';

                        if($data_inicial && $data_final){
                            $html .= '<p>'.formata_data_banco_sem_hora($data_inicial).'-'.formata_data_banco_sem_hora($data_final).'</p>';
                        }else{
                            $html .= '<p>'.formata_data_banco_sem_hora($data_inicial).'</p>'; 
                        }

                        $html .= '<hr>';

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Venda</th>';
                                $html .= '<th>Data</th>';
                                $html .= '<th>Cliente</th>';
                                $html .= '<th>Forma de pagamento</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            $venda_valor_total = 0;
                            foreach($vendas as $venda){

                                $html .= '<tr>';

                                    $html .= '<td>'.$venda->venda_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($venda->venda_data_emissao).'</td>';
                                    $html .= '<td>'.$venda->cliente_nome_completo.'</td>';
                                    $html .= '<td>'.$venda->venda_forma_pagamento_id.'</td>';
                                    $html .= '<td>R$&nbsp;'.$venda->venda_valor_total.'</td>';

                                $html .= '</tr>';
                                $venda_valor_total = $venda_valor_total + $venda->venda_valor_total;

                            }

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$venda_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

            }else{
                if(!empty($data_inicial) && !empty($data_final)){

                    $this->session->set_flashdata('info', 'Não foram encontradas vendas entre as datas pesquisadas&nbsp;'.formata_data_banco_sem_hora($data_inicial).' - '.formata_data_banco_sem_hora($data_final));

                }else{

                    $this->session->set_flashdata('info', 'Não foram encontradas vendas pela a data pesquisada&nbsp;'.formata_data_banco_sem_hora($data_inicial));

                }

                redirect('relatorios/vendas');
            }

        }

                $this->load->view('layout/header', $data);
                $this->load->view('relatorios/vendas');
                $this->load->view('layout/footer');

    }

    public function os(){

        $data = array(
            'titulo' => 'Relatórios de ordens de serviços'
        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

        // echo"<pre>";
        // print_r($this->input->post());
        // exit();

        if($data_inicial){

            $this->load->model('ordem_servicos_model');

            if($this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final)){

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $ordens_servicos = $this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final);
                
                $file_name = 'Relatório de ordens de serviços';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de ordens de serviços</title>';

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

                        $html .= '<p>Relatório ordens de serviços realizadas na data:</p>';

                        if($data_inicial && $data_final){
                            $html .= '<p>'.formata_data_banco_sem_hora($data_inicial).'-'.formata_data_banco_sem_hora($data_final).'</p>';
                        }else{
                            $html .= '<p>'.formata_data_banco_sem_hora($data_inicial).'</p>'; 
                        }

                        $html .= '<hr>';

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Ordem</th>';
                                $html .= '<th>Data</th>';
                                $html .= '<th>Cliente</th>';
                                $html .= '<th>Forma de pagamento</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            $valor_final_os = $this->ordem_servicos_model->get_valor_final_relatorio($data_inicial, $data_final); 

                            foreach($ordens_servicos as $os){

                                $html .= '<tr>';

                                    $html .= '<td>'.$os->ordem_servico_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($os->ordem_servico_data_emissao).'</td>';
                                    $html .= '<td>'.$os->cliente_nome_completo.'</td>';
                                    $html .= '<td>'.$os->forma_pagamento.'</td>';
                                    $html .= '<td>R$&nbsp;'.$os->ordem_servico_valor_total.'</td>';

                                $html .= '</tr>';

                            }

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final_os->ordem_servico_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

            }else{
                if(!empty($data_inicial) && !empty($data_final)){

                    $this->session->set_flashdata('info', 'Não foram encontradas ordens de serviços entre as datas pesquisadas&nbsp;'.formata_data_banco_sem_hora($data_inicial).' - '.formata_data_banco_sem_hora($data_final));

                }else{

                    $this->session->set_flashdata('info', 'Não foram encontradas ordens de serviçoes pela a data pesquisada&nbsp;'.formata_data_banco_sem_hora($data_inicial));

                }

                redirect('relatorios/os');
            }

        }

                $this->load->view('layout/header', $data);
                $this->load->view('relatorios/os');
                $this->load->view('layout/footer');

    }


    public function receber(){

        $data = array(
            'titulo' => 'Relatório contas a receber'
        );

        $contas = $this->input->post('contas');

        if($contas == 'vencidas' || $contas == 'receber' || $contas == 'pagas'){

            $this->load->model('financeiro_model');

            if($contas == 'vencidas'){

                $conta_receber_status = 0;
                $data_vencimento = true;

                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)){

                    $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);
                
                $file_name = 'Relatório de contas vencidas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas vencidas</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Venda ID</th>';
                                $html .= '<th>Data vencimento</th>';
                                $html .= '<th>Cliente</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_receber_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_receber_data_vencto).'</td>';
                                    $html .= '<td>'.$conta->cliente_nome.'</td>';
                                    $html .= '<td>Vencida</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_receber_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_receber_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas vencidas na base de dados');
                    redirect('relatorios/receber');
                }
            }


            if($contas == 'pagas'){

                $conta_receber_status = 1;

                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)){

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);
                
                $file_name = 'Relatório de contas pagas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas pagas</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Conta ID</th>';
                                $html .= '<th>Data pagamento</th>';
                                $html .= '<th>Cliente</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_receber_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_receber_data_pagamento).'</td>';
                                    $html .= '<td>'.$conta->cliente_nome.'</td>';
                                    $html .= '<td>Paga</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_receber_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_receber_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas pagas na base de dados');
                    redirect('relatorios/receber');
                }
            }


            if($contas == 'receber'){

                $conta_receber_status = 0;

                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)){

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);
                
                $file_name = 'Relatório de contas a receber';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas a receber</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Conta ID</th>';
                                $html .= '<th>Data vencimento</th>';
                                $html .= '<th>Cliente</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_receber_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_receber_data_vencto).'</td>';
                                    $html .= '<td>'.$conta->cliente_nome.'</td>';
                                    $html .= '<td>A receber</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_receber_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_receber_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas a receber na base de dados');
                    redirect('relatorios/receber');
                }
            }
            
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/receber');
        $this->load->view('layout/footer');

    }

    public function pagar(){

        $data = array(
            'titulo' => 'Relatório contas a pagar'
        );

        $contas = $this->input->post('contas');

        if($contas == 'vencidas' || $contas == 'a_pagar' || $contas == 'pagas'){

            $this->load->model('financeiro_model');

            if($contas == 'vencidas'){

                $conta_pagar_status = 0;
                $data_vencimento = true;

                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){

                    $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
                
                $file_name = 'Relatório de contas vencidas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas vencidas</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Conta ID</th>';
                                $html .= '<th>Data vencimento</th>';
                                $html .= '<th>Fornecedor</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_pagar_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_pagar_data_vencto).'</td>';
                                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                                    $html .= '<td>Vencida</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_pagar_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_pagar_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas vencidas na base de dados');
                    redirect('relatorios/pagar');
                }
            }

            if($contas == 'pagas'){

                $conta_pagar_status = 1;
                $data_vencimento = false;

                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){

                    $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
                
                $file_name = 'Relatório de contas pagas';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas pagas</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Conta ID</th>';
                                $html .= '<th>Data pagamento</th>';
                                $html .= '<th>Fornecedor</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_pagar_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_pagar_data_pagamento).'</td>';
                                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                                    $html .= '<td>Paga</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_pagar_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_pagar_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas pagas na base de dados');
                    redirect('relatorios/pagar');
                }
            }

            if($contas == 'a_pagar'){

                $conta_pagar_status = 0;
                $data_vencimento = false;

                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){

                    $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
                
                $file_name = 'Relatório de contas a pagar';

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Relatório de contas a pagar</title>';

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

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Conta ID</th>';
                                $html .= '<th>Data vencimento</th>';
                                $html .= '<th>Fornecedor</th>';
                                $html .= '<th>Situação</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            foreach($contas as $conta){

                                $html .= '<tr>';

                                    $html .= '<td>'.$conta->conta_pagar_id.'</td>';
                                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_pagar_data_vencto).'</td>';
                                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                                    $html .= '<td>A pagar</td>';
                                    $html .= '<td>R$&nbsp;'.$conta->conta_pagar_valor.'</td>';

                                $html .= '</tr>';

                            }

                            $valor_final = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento); 

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final->conta_pagar_valor_total.'</td>';
                            $html .= '</th>';

                        $html .= '</table>';

                    $html .= '</body>';

                $html .= '<html>';

                // echo"<pre>";
                // print_r($html);
                // exit();

                //false -> abre no navegador
                //true -> faz download
                $this->pdf->createPDF($html, $file_name, false);

                }else{
                    $this->session->set_flashdata('info', 'Não existe contas a pagar na base de dados');
                    redirect('relatorios/pagar');
                }
            }

        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/pagar');
        $this->load->view('layout/footer');

    }

   
}