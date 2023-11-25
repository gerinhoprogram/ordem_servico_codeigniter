<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Ordem_servicos extends CI_Controller{

    public function __construct(){
        parent:: __construct();

        //se não estiver logado volta para login
        if(!$this->ion_auth->logged_in()){
            redirect ('login');
        }

        $this->load->model('ordem_servicos_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Ordens de serviços cadastrados',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'ordem_servicos' => $this->ordem_servicos_model->get_all(),
        );

        // echo"<pre>";
        // print_r($data['ordem_servicos']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

        $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
        $this->form_validation->set_rules('ordem_servico_equipamento', 'Marca', 'trim|required');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
        $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[500]');

        if($this->form_validation->run()){

            // echo"<pre>";
            // print_r($this->input->post());
            // exit();

            $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

             // array para salvar no banco de dados
             $data = elements(
                array(
                    'ordem_servico_cliente_id',
                    'ordem_servico_status',
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_defeito',
                    'ordem_servico_acessorios',
                    'ordem_servico_obs',
                    'ordem_servico_valor_desconto',
                    'ordem_servico_valor_total',
                ), $this->input->post()
            );

            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total ));

            // limpa dados perigosos
            $data = html_escape($data);

            // salva no banco de dados
            $this->core_model->insert('ordens_servicos', $data, true);

            // recupera ultimo id salvo
            $id_ordem_servico = $this->session->userdata('last_id');

            $servico_id = $this->input->post('servico_id');
            $servico_quantidade = $this->input->post('servico_quantidade');

            // str_replace()
            // 1retira oq quer, 2substitui, 3valor a ser alterado
            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
            $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

            //conta quantos servicos tem no array
            // $qty_servico = count('servico_id');
            $qty_servico = 0;
            foreach($servico_id as $serv){
                $qty_servico ++;
            }

            $ordem_servico_id = $this->input->post('ordem_servico_id');

            for($i = 0; $i < $qty_servico; $i++){
                $data = array(
                    'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                    'ordem_ts_id_servico' => $servico_id[$i],
                    'ordem_ts_quantidade' => $servico_quantidade[$i],
                    'ordem_ts_valor_unitario' => $servico_preco[$i],
                    'ordem_ts_valor_desconto' => $servico_desconto[$i],
                    'ordem_ts_valor_total' =>$servico_item_total[$i],
                );

                $data = html_escape($data);

                $this->core_model->insert('ordem_tem_servicos', $data);
            }

            redirect('os/imprimir/'. $id_ordem_servico);

        }else{

            $data = array(

                'titulo' => 'Cadastrar Ordem de serviço',
               
                'styles' => array(
                    'vendor/select2/select2.min.css',
                    'vendor/autocomplete/jquery-ui.css',
                    'vendor/autocomplete/estilo.css',
                ),
    
                'scripts' => array(
                    'vendor/autocomplete/jquery-migrate.js',
                    'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendor/calcx/os.js',
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/sweetalert2/sweetalert2.js',
                    'vendor/autocomplete/jquery-ui.js',
                ),
                'clientes' => $this->core_model->get_all('clientes_tab', array('cliente_ativo' => 1)),
                 );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/add');
            $this->load->view('layout/footer');
        }
    }

    public function editar($ordem_servico_id = null){

        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrado');
            redirect('os');

        }else{

            $ordem_servico_status = $this->input->post('ordem_servico_status');

            if($ordem_servico_status == 1){
                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            }

            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', 'Marca', 'trim|required');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[500]');

            if($this->form_validation->run()){

                // echo"<pre>";
                // print_r($this->input->post());
                // exit();

                $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

                 // array para salvar no banco de dados
                 $data = elements(
                    array(
                        'ordem_servico_cliente_id',
                        'ordem_servico_forma_pagamento_id',
                        'ordem_servico_status',
                        'ordem_servico_equipamento',
                        'ordem_servico_marca_equipamento',
                        'ordem_servico_modelo_equipamento',
                        'ordem_servico_defeito',
                        'ordem_servico_acessorios',
                        'ordem_servico_obs',
                        'ordem_servico_valor_desconto',
                        'ordem_servico_valor_total',
                    ), $this->input->post()
                );

                //unset retira de $data o campo ordem_servico_pagamento_id
                if($ordem_servico_status == 0){
                    unset($data['ordem_servico_forma_pagamento_id']);
                }

                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total ));

                // limpa dados perigosos
                $data = html_escape($data);

                // salva no banco de dados
                $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));

                // deleta de ordem_tem_servicos, os serviços antigos da ordem editada
                $this->ordem_servicos_model->delete_old_services($ordem_servico_id);

                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');

                // str_replace()
                // 1retira oq quer, 2substitui, 3valor a ser alterado
                $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
                $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

                //conta quantos servicos tem no array
                // $qty_servico = count('servico_id');
                $qty_servico = 0;
                foreach($servico_id as $serv){
                    $qty_servico ++;
                }

                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for($i = 0; $i < $qty_servico; $i++){
                    $data = array(
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' =>$servico_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('ordem_tem_servicos', $data);
                }

                redirect('os/imprimir/'. $ordem_servico_id);

            }else{

                $data = array(

                    'titulo' => 'Atualizar Ordem de serviço',
                   
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
        
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/os.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes_tab', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),
                );

                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);


                // echo"<pre>";
                // print_r($data['os_tem_servicos']);
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/edit');
                $this->load->view('layout/footer');
            }

        }

    }

    
    public function deletar($ordem_servico_id = null){

        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
            $this->session->set_flashdata('error', 'Ordem de serviço não enontrado!');
            redirect('os');
        }

        if($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status' => 0))){
            $this->session->set_flashdata('error', 'Não foi possível excluir Ordem de serviço, esta em aberto!');
            redirect('os');
        }

        // deletar
        $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id));
        redirect('os');
    }

    public function imprimir($ordem_servico_id = null){

        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
            $this->session->set_flashdata('error', 'Ordem de serviço não enontrado!');
            redirect('os');
        }else{

                $data = array(
                    'titulo' => 'Escolha uma opção',
                    'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/imprimir');
                $this->load->view('layout/footer');

        }

    }

    public function pdf($ordem_servico_id = null){
        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))){
            $this->session->set_flashdata('error', 'Ordem de serviço não enontrado!');
            redirect('os');
        }else{

                $empresa = $this->core_model->get_by_id('system', array('id' => 1));

                $ordem_servico = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
                
                $file_name = 'O.S&nbsp;' . $ordem_servico->ordem_servico_id;

                $html = '<html>';

                    $html .= '<head>';
                    
                        $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de O.S.</title>';

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

                        $html .= '<p>O. S. Nº&nbsp;'.$ordem_servico->ordem_servico_id.'<br>';

                        $html .= 
                                '<strong>Cliente:&nbsp;</strong>'.$ordem_servico->cliente_nome.'&nbsp;'.$ordem_servico->cliente_sobrenome.'
                                <br><strong>Celular:&nbsp;</strong>'.$ordem_servico->cliente_telefone.'
                                </p>';

                        $html .= '<hr>';

                        //dados da ordem
                       
                        $html .= '<table width="100%" style="border: solid #ddd 1px">';

                            $html .= '<tr>';

                                $html .= '<th>Serviço</th>';
                                $html .= '<th>Quantidade</th>';
                                $html .= '<th>Valor unitário</th>';
                                $html .= '<th>Desconto</th>';
                                $html .= '<th>Valor total</th>';

                            $html .= '</tr>';

                        

                            $ordem_servico_id = $ordem_servico->ordem_servico_id;

                            $servicos_ordem = $this->ordem_servicos_model->get_all_services($ordem_servico_id);

                            $valor_final_os = $this->ordem_servicos_model->valor_final_os($ordem_servico_id);

                            foreach($servicos_ordem as $servico){

                                $html .= '<tr>';

                                    $html .= '<td>'.$servico->servico_nome.'</td>';
                                    $html .= '<td>'.$servico->ordem_ts_quantidade.'</td>';
                                    $html .= '<td>R$&nbsp;'.$servico->ordem_ts_valor_unitario.'</td>';
                                    $html .= '<td>%&nbsp;'.$servico->ordem_ts_valor_desconto.'</td>';
                                    $html .= '<td>R$&nbsp;'.$servico->ordem_ts_valor_total.'</td>';

                                $html .= '</tr>';

                            }

                            $html .= '<th colspan="3">';
                                $html .= '<td><strong>Valor final</strong></td>';
                                $html .= '<td>R$&nbsp;'.$valor_final_os->os_valor_total.'</td>';
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