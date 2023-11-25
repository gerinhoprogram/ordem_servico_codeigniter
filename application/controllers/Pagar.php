<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Pagar extends CI_Controller{

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
        $this->load->model('financeiro_model');
    }

    public function index(){

        $data = array(

            'titulo' => 'Contas a pagar cadastradas',

            //cria array de estilos para passar para view header
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js', 
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'),
            
            //carrega dados da tabela clientes
            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        );

        // echo'<pre>';
        // print_r($data['contas_pagar']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');

    }

    public function adicionar(){

        $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
            $this->form_validation->set_rules('conta_pagar_data_vencto', '', 'required');
            $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
            $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[200]');

            if($this->form_validation->run()){

               $data = elements(
                   array(
                       'conta_pagar_fornecedor_id',
                       'conta_pagar_data_vencto',
                       'conta_pagar_obs',
                       'conta_pagar_valor',
                       'conta_pagar_status',
                   ), $this->input->post()
               );

               $conta_pagar_status = $this->input->post('conta_pagar_status');

               if($conta_pagar_status = 1){
                   $data['conta_pagar_data_pagamento'] = date('y-m-d h:i:s');
               }

               $data = html_escape($data);

               $this->core_model->insert('contas_pagar', $data);
               redirect('pagar');

            }else{

                $data = array(

                    'titulo' => 'Adicionar Contas a pagar',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/select2/select2.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js'),
                        
                    //carrega dados da tabela clientes
                    'conta_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id')),
                    'fornecedores' => $this->core_model->get_all('fornecedores_tab'),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('pagar/add');
                $this->load->view('layout/footer');
            }

    }

    public function editar($conta_pagar_id = null){

        if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))){
            $this->session->set_flashdata('error', 'Conta não encontrada');
        }else{

            $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
            $this->form_validation->set_rules('conta_pagar_data_vencto', '', 'required');
            $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
            $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[200]');

            if($this->form_validation->run()){

               $data = elements(
                   array(
                       'conta_pagar_fornecedor_id',
                       'conta_pagar_data_vencto',
                       'conta_pagar_obs',
                       'conta_pagar_valor',
                       'conta_pagar_status',
                   ), $this->input->post()
               );

               $conta_pagar_status = $this->input->post('conta_pagar_status');

               if($conta_pagar_status = 1){
                   $data['conta_pagar_data_pagamento'] = date('y-m-d h:i:s');
               }

               $data = html_escape($data);

               $this->core_model->update('contas_pagar', $data, array('conta_pagar_id' => $conta_pagar_id));
               redirect('pagar');

            }else{

                $data = array(

                    'titulo' => 'Editar Contas a pagar',
        
                    //cria array de estilos para passar para view header
                    'styles' => array('vendor/select2/select2.min.css'),
        
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js'),
                        
                    //carrega dados da tabela clientes
                    'conta_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id)),
                    'fornecedores' => $this->core_model->get_all('fornecedores_tab'),
                );
        
                $this->load->view('layout/header', $data);
                $this->load->view('pagar/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($conta_pagar_id = null){

        if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))){
            $this->session->set_flashdata('error', 'Conta não encontrada');
            redirect('pagar');
        }

        if($this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id, 'conta_pagar_status' => 0))){
            $this->session->set_flashdata('info', 'Conta ainda está em aberto!');
            redirect('pagar');
        }

        $this->core_model->delete('contas_pagar', array('conta_pagar_id' => $conta_pagar_id));
        redirect('pagar');

    }
}