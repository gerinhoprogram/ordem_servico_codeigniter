<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Vendas extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        $this->load->model('vendas_model');
        $this->load->model('produtos_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Vendas cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela vendas
            'vendas' => $this->vendas_model->get_all(),
        );

        // echo"<pre>";
        // print_r($data['vendas']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){
      
        $this->form_validation->set_rules('venda_cliente_id', '', 'required');
        $this->form_validation->set_rules('venda_tipo', '', 'required');
        $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
        $this->form_validation->set_rules('venda_vendedor_id', '', 'required');

        if($this->form_validation->run()){

            $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

             // array para salvar no banco de dados
             $data = elements(
                array(
                    'venda_cliente_id',
                    'venda_forma_pagamento_id',
                    'venda_tipo',
                    'venda_vendedor_id',
                    'venda_valor_desconto',
                    'venda_valor_total',
                ), $this->input->post()
            );

            $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total ));

            // limpa dados perigosos
            $data = html_escape($data);

            // salva no banco de dados
            $this->core_model->insert('vendas_tab', $data, true);

            $id_venda = $this->session->userdata('last_id');

            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');

            // str_replace()
            // 1retira oq quer, 2substitui, 3valor a ser alterado
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
            $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

            //conta quantos produtos tem no array
            $qty_produto = 0;
            foreach($produto_id as $prod){
                $qty_produto ++;
            }

            for($i = 0; $i < $qty_produto; $i++){
                $data = array(
                    'venda_produto_id_venda' => $id_venda,
                    'venda_produto_id_produto' => $produto_id[$i],
                    'venda_produto_quantidade' => $produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                    'venda_produto_desconto' => $produto_desconto[$i],
                    'venda_produto_valor_total' => $produto_item_total[$i],
                );

                $data = html_escape($data);

                $this->core_model->insert('venda_produtos', $data);

                //inicio para atualizar estoque
                $produto_qtde_estoque = 0;
                $produto_qtde_estoque += intval($produto_quantidade[$i]);
                $produtos = array(
                    'produto_qtde_estoque' => $produto_qtde_estoque,
                );

                $this->produtos_model->update($produto_id[$i], $produto_qtde_estoque);

                // fim atualização de estoque
            }

            redirect('vendas/imprimir/'. $id_venda);

        }else{

            $data = array(

                'titulo' => 'Cadastrar Venda',
               
                'styles' => array(
                    'vendor/select2/select2.min.css',
                    'vendor/autocomplete/jquery-ui.css',
                    'vendor/autocomplete/estilo.css',
                ),
    
                'scripts' => array(
                    'vendor/autocomplete/jquery-migrate.js',
                    'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendor/calcx/venda.js',
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/sweetalert2/sweetalert2.js',
                    'vendor/autocomplete/jquery-ui.js',
                ),
                'clientes' => $this->core_model->get_all('clientes_tab', array('cliente_ativo' => 1)),
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/add');
            $this->load->view('layout/footer');
        }
    }

    public function editar($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas_tab', array('venda_id' => $venda_id))){

            $this->session->set_flashdata('error', 'Venda não encontrado');
            redirect('vendas');

        }else{

            //atualização de estoque
            $venda_produtos = $data['venda_produtos'] = $this->vendas_model->get_all_produtos_by_venda($venda_id);

            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('venda_vendedor_id', '', 'required');

            if($this->form_validation->run()){

                $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'venda_cliente_id',
                        'venda_forma_pagamento_id',
                        'venda_tipo',
                        'venda_vendedor_id',
                        'venda_valor_desconto',
                        'venda_valor_total',
                    ), $this->input->post()
                );

                $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total ));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('vendas_tab', $data, array('venda_id' => $venda_id));

                // deleta de venda, os produtos antigos da venda editada
                $this->vendas_model->delete_old_produtos($venda_id);

                $produto_id = $this->input->post('produto_id');
                $produto_quantidade = $this->input->post('produto_quantidade');

                // str_replace()
                // 1retira oq quer, 2substitui, 3valor a ser alterado
                $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
                $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
                $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

                //conta quantos produtos tem no array
                $qty_produto = 0;
                foreach($produto_id as $prod){
                    $qty_produto ++;
                }

                $venda_id = $this->input->post('venda_id');

                for($i = 0; $i < $qty_produto; $i++){
                    $data = array(
                        'venda_produto_id_venda' => $venda_id,
                        'venda_produto_id_produto' => $produto_id[$i],
                        'venda_produto_quantidade' => $produto_quantidade[$i],
                        'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);

                    //inicio para atualizar estoque
                    foreach($venda_produtos as $venda_p){

                        if($venda_p->venda_produto_quantidade < $produto_quantidade[$i]){

                            $produto_qtde_estoque = 0;

                            //intval tranforma em um inteiro
                            $produto_qtde_estoque += intval($produto_quantidade[$i]);
                            $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);
                            
                            $this->produtos_model->update($produto_id[$i], $diferenca);

                        }

                    }
                    // fim atualização de estoque
                }

                // redirect('vendas/imprimir/'. $venda_id);
                redirect('vendas');

            }else{

                $data = array(

                    'titulo' => 'Atualizar Venda',
                   
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
        
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/venda.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes_tab', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                    'venda' => $this->vendas_model->get_by_id($venda_id),
                    'venda_produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
                    'desabilitar' => true,
                );

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas_tab', array('venda_id' => $venda_id))){
            $this->session->set_flashdata('error', 'Venda não enontrada!');
            redirect('os');
        }else{
            // deletar
            $this->core_model->delete('vendas_tab', array('venda_id' => $venda_id));
            redirect('vendas');
        }

        
    }

    public function imprimir($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas_tab', array('venda_id' => $venda_id))){
            $this->session->set_flashdata('error', 'Venda não enontrada!');
            redirect('os');
        }else{

                $data = array(
                    'titulo' => 'Escolha uma opção',
                    'venda' => $this->core_model->get_by_id('vendas_tab', array('venda_id' => $venda_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/imprimir');
                $this->load->view('layout/footer');

        }

    }

    public function pdf($venda_id = null){
        if(!$venda_id || !$this->core_model->get_by_id('vendas_tab', array('venda_id' => $venda_id))){
            $this->session->set_flashdata('error', 'Venda não enontrada!');
            redirect('vendas');
        }else{

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $venda = $this->vendas_model->get_by_id($venda_id);
                
                $file_name = 'Venda&nbsp;' . $venda->venda_id;

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Venda</title>';

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

                        $html .= '<p>Venda Nº&nbsp;'.$venda->venda_id.'<br>';

                        $html .= 
                                '<strong>Cliente:&nbsp;</strong>'.$venda->cliente_nome_completo.'
                                <br><strong>Telefone:&nbsp;</strong>'.$venda->cliente_telefone.'
                                </p>';

                        $html .= '<hr>';

                        //dados da venda
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Códigp</th>';
                                $html .= '<th>Descrição</th>';
                                $html .= '<th>Quantidade</th>';
                                $html .= '<th>Valor unitário</th>';
                                $html .= '<th>Desconto</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                            // $venda_id = $venda->venda_id;

                            $produtos_venda = $this->vendas_model->get_all_produtos($venda_id);

                            $valor_final_venda = $this->vendas_model->valor_final_venda($venda_id);

                            foreach($produtos_venda as $produto){

                                $html .= '<tr>';

                                    $html .= '<td>'.$produto->venda_produto_id_produto.'</td>';
                                    $html .= '<td>'.$produto->produto_descricao.'</td>';
                                    $html .= '<td>'.$produto->venda_produto_quantidade.'</td>';
                                    $html .= '<td>R$&nbsp;'.$produto->venda_produto_valor_unitario.'</td>';
                                    $html .= '<td>%&nbsp;'.$produto->venda_produto_desconto.'</td>';
                                    $html .= '<td>R$&nbsp;'.$produto->venda_produto_valor_total.'</td>';

                                $html .= '</tr>';

                            }

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final_venda->venda_valor_total.'</td>';
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

        }
    }
}